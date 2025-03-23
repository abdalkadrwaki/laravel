<?php
namespace App\Http\Controllers;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SubUserController extends Controller
{
    // إرجاع صفحة إنشاء المستخدم الفرعي
    public function create()
    {
        return view('sub_users.create');
    }

    // دالة تخزين بيانات المستخدم الفرعي
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // إنشاء المستخدم الفرعي وربطه بالمستخدم الأصلي
        $subUser = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => bcrypt($validated['password']),
            'parent_id' => auth()->id(),
            'role_id'   => 3, // تحديد القيمة الافتراضية المطلوبة
        ]);

        DB::table('friend_requests')->insert([
            'sender_id'   => auth()->id(),   // رقم المستخدم الرئيسي
            'receiver_id' => $subUser->id,     // رقم المستخدم الفرعي الذي تم إنشاؤه
            'status'      => 'accepted',       // الحالة
            'parent_id'   => auth()->id(),     // نفس رقم المستخدم الرئيسي
        ]);

        return response()->json([
            'message' => 'تم إنشاء المستخدم الفرعي بنجاح',
            'data'    => $subUser,
        ], 201);
    }
}
