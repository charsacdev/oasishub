<?php

// app/Http/Middleware/CheckProfileStatus.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // If not logged in, redirect to login
        if (!$user) {
            return redirect('/login');
        }

        // Check profile status
        if ($user->profile_status !== 'active') {
            #return redirect('/dashboard?type=profile')->with('warning', 'Please update your profile before shopping.');
        }

        return $next($request);
    }
}

?>
