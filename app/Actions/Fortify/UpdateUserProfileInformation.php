<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'Office_name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo'         => ['nullable', 'image', 'max:1024'],

            // الحقول الجديدة:
            'user_address'  => ['nullable', 'string', 'max:255'],
            'country_user'  => ['nullable', 'string', 'max:255'],
            'state_user'    => ['nullable', 'string', 'max:255'],
            // نستخدم قاعدة digits:16 للتحقق من وجود 16 رقم بالضبط.
            'link_number'   => ['required', 'digits:16'],
        ])->validate();

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'Office_name'         => $input['Office_name'],
                'email'        => $input['email'],
                'user_address' => $input['user_address'] ?? null,
                'country_user' => $input['country_user'] ?? null,
                'state_user'   => $input['state_user'] ?? null,
                'link_number'  => $input['link_number'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'Office_name'            => $input['Office_name'],
            'email'           => $input['email'],
            'user_address'    => $input['user_address'] ?? null,
            'country_user'    => $input['country_user'] ?? null,
            'state_user'      => $input['state_user'] ?? null,
            'link_number'     => $input['link_number'],
            'email_verified_at'=> null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
