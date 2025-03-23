<x-jet-form-section submit="updateProfileInformation" >
    <x-slot name="title" class=" right-88">
        {{ __('تحديث الملف الشخصي') }}
    </x-slot>

    <x-slot name="description">
        {{ __('قم بتحديث معلومات ملفك الشخصي للحفاظ على بياناتك محدثة.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo Section -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="col-span-12 mb-8">
                <div x-data="{photoName: null, photoPreview: null}" class="flex items-center space-x-6">
                    <!-- Current Profile Photo -->
                    <div x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}"
                             alt="{{ $this->user->name }}"
                             class="rounded-full h-24 w-24 object-cover border-4 border-gray-200">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div x-show="photoPreview" class="shrink-0">
                        <span class="block rounded-full w-24 h-24 bg-cover bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <div class="flex flex-col space-y-3">
                        <div class="flex space-x-3">
                            <x-jet-secondary-button
                                type="button"
                                x-on:click.prevent="$refs.photo.click()"
                                class="px-6 py-2 text-sm font-medium">
                                {{ __('اختر صورة جديدة') }}
                            </x-jet-secondary-button>

                            @if ($this->user->profile_photo_path)
                                <x-jet-secondary-button
                                    type="button"
                                    wire:click="deleteProfilePhoto"
                                    class="px-6 py-2 text-sm font-medium">
                                    {{ __('إزالة الصورة') }}
                                </x-jet-secondary-button>
                            @endif
                        </div>
                        <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                            x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => { photoPreview = e.target.result; };
                                reader.readAsDataURL($refs.photo.files[0]);
                            ">
                        <x-jet-input-error for="photo" class="mt-2" />
                    </div>
                </div>
            </div>
        @endif

        <!-- الصف الأول: الاسم والبريد الإلكتروني -->
        <div class="col-span-12 grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <!-- Name -->
            <div class="sm:col-span-1">
                <x-jet-label for="Office_name" value="{{ __('الاسم مكتب') }}" class="block text-sm font-medium text-gray-700"/>
                <x-jet-input id="Office_name" type="text" class="mt-1 block w-full rounded-lg"
                           wire:model.defer="state.Office_name" autocomplete="Office_name"/>
                <x-jet-input-error for="Office_name" class="mt-2 text-sm"/>
            </div>

            <!-- Email -->
            <div class="sm:col-span-1">
                <x-jet-label for="email" value="{{ __('البريد الإلكتروني') }}" class="block text-sm font-medium text-gray-700"/>
                <x-jet-input id="email" type="email" class="mt-1 block w-full rounded-lg"
                           wire:model.defer="state.email"/>
                <x-jet-input-error for="email" class="mt-2 text-sm"/>
            </div>
        </div>

        <!-- الصف الثاني: الدولة والولاية -->
        <div class="col-span-12 grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <!-- Country -->
            <div class="sm:col-span-1">
                <x-jet-label for="country_user" value="{{ __('الدولة') }}" class="block text-sm font-medium text-gray-700"/>
                <x-jet-input id="country_user" type="text" class="mt-1 block w-full rounded-lg"
                           wire:model.defer="state.country_user"/>
                <x-jet-input-error for="country_user" class="mt-2 text-sm"/>
            </div>

            <!-- State -->
            <div class="sm:col-span-1">
                <x-jet-label for="state_user" value="{{ __('الولاية') }}" class="block text-sm font-medium text-gray-700"/>
                <x-jet-input id="state_user" type="text" class="mt-1 block w-full rounded-lg"
                           wire:model.defer="state.state_user"/>
                <x-jet-input-error for="state_user" class="mt-2 text-sm"/>
            </div>
        </div>

        <!-- الصف الثالث: Link Number -->
        <div class="col-span-12 mb-6" x-data>
            <x-jet-label for="link_number" value="رقم حساب" class="block text-sm font-medium text-gray-700"/>
            <div class="flex flex-col sm:flex-row gap-4 mt-1">
                <div class="flex-1">
                    <x-jet-input id="link_number" type="text" class="w-full rounded-lg"
                               wire:model.defer="state.link_number"
                               pattern="\d{16}" maxlength="16" minlength="16"
                               x-ref="linkNumberInput"/>
                </div>
                <div class="flex gap-2 flex-wrap">
                    <button type="button"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm"
                    x-on:click="
                        navigator.clipboard.writeText($refs.linkNumberInput.value)
                            .then(() => alert('Copied!'))
                            .catch(err => console.error('Error copying text: ', err));
                    ">
                {{ __('نسخ الرقم') }}
            </button>
            <button type="button"
            class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-700 text-sm"
            x-on:click="
                // توليد رقم عشوائي مكوّن من 16 رقم
                let randomNum = Math.floor(Math.random() * 1e16).toString().padStart(16, '0');
                // تحديث قيمة الحقل
                $refs.linkNumberInput.value = randomNum;
                // إرسال حدث 'input' لتحديث خاصية Livewire أيضًا
                $refs.linkNumberInput.dispatchEvent(new Event('input'));
            ">
        {{ __('توليد رقم جديد') }}
    </button>
                </div>
            </div>
            <x-jet-input-error for="link_number" class="mt-2 text-sm"/>
        </div>


        <!-- الصف الرابع: العنوان -->
        <div class="col-span-12">
            <x-jet-label for="user_address" value="{{ __('عنوان') }}" class="block text-sm font-medium text-gray-700"/>
            <textarea id="user_address" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                      wire:model.defer="state.user_address" rows="3"></textarea>
            <x-jet-input-error for="user_address" class="mt-2 text-sm"/>
        </div>
    </x-slot>

    <x-slot name="actions" >
        <div class="col-span-12 flex justify-end items-center space-x-4 mt-8">
            <x-jet-action-message on="saved" class="text-green-600 text-sm font-medium">
                {{ __('تم الحفظ بنجاح.') }}
            </x-jet-action-message>

            <x-jet-button class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-sm font-medium rounded-lg">
                {{ __('حفظ') }}
            </x-jet-button>
        </div>
    </x-slot>
</x-jet-form-section>
