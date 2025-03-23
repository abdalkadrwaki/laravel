<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        // إضافة سياسة CSP لتسمح بتحميل السكربتات من chrome-extension
        $response = $next($request);

        // إضافة ترويسة CSP
        $response->headers->set('Content-Security-Policy', "script-src 'self' 'chrome-extension:' 'wasm-unsafe-eval' 'inline-speculation-rules';");

        return $response;
    }
}

