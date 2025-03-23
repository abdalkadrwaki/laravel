<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthenticatedSessionController extends Controller
{
    // تسجيل الخروج
    public function destroy(Request $request)
    {
        Auth::logout(); // تسجيل الخروج
        $request->session()->invalidate(); // إبطال الجلسة
        $request->session()->regenerateToken(); // إنشاء توكن جديد

        return redirect('/'); // إعادة التوجيه إلى الصفحة الرئيسية
    }
}
