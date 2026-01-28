<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssignGuestId
{
    public function handle(Request $request, Closure $next): Response
    {
        // If cookie doesn't exist, set a new one
        if (!$request->hasCookie('guest_user_id')) {
            $guestId = Str::uuid()->toString();
            cookie()->queue(cookie('guest_user_id', $guestId, 60 * 24 * 30)); // valid for 30 days
        }

        return $next($request);
    }
}
