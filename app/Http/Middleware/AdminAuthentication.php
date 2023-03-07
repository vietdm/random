<?php

namespace App\Http\Middleware;

use App\Enum\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthentication
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check())
            return redirect('/admin/login');

        $user = auth()->user();
        if (RoleEnum::ADMIN !== $user->role)
            return redirect('/');

        $request->user = $user;
        return $next($request);
    }
}
