<?php

namespace App\Http\Middleware;

use Closure;

class SecureHeadersMiddleware
{
    /**
     * التعامل مع الطلب وإضافة رؤوس الأمان.
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // منع clickjacking
        $response->headers->set('X-Frame-Options', 'DENY');
        // تفعيل حماية XSS
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        // منع متصفحك من تفسير أنواع الملفات بشكل خاطئ
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}
