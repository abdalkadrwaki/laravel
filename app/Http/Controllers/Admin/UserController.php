<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
class UserController extends Controller
{
    public function index()
    {
        if (Gate::denies('Administrator')) {
            abort(403);
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|in:1,2,3',
            'state_user'=> 'required|string|max:255',
        ]);

        // إنشاء رقم عشوائي مكون من 16 خانة
        $linkNumber = str_pad(random_int(0, 9999999999999999), 16, '0', STR_PAD_LEFT);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'link_number' => $linkNumber,
            'state_user' => $request->state_user,

        ]);

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    }


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|in:1,2,3',
            'state_user'=> 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'state_user' => $request->state_user,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }





public function terminateSession(User $user)
{
    // حذف جميع الجلسات النشطة للمستخدم
    DB::table('sessions')->where('user_id', $user->id)->delete();

    return redirect()->route('admin.users.index')->with('success', 'User session terminated successfully.');
}

}
