<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! session('is_admin')) {
            return redirect()->route('admin.login')
                ->with('error', 'この操作には管理者ログインが必要です。');
        }

        return $next($request);
    }
}
