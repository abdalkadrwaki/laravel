<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * الحصول على المسار الذي يجب إعادة توجيه المستخدم إليه عندما لا يكون مصادقًا.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // إذا لم يكن المستخدم مسجلاً للدخول وكان الطلب لا يتوقع JSON، يتم إعادة توجيهه إلى صفحة تسجيل الدخول.
        if (! $request->expectsJson() && ! $request->user()) {
            return route('login'); // تأكد من أن المسار 'login' هو المسار الصحيح لتسجيل الدخول
        }
    }
}
