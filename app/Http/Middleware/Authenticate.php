<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
<<<<<<< HEAD
        return $request->expectsJson() ? null : route('login');
=======
        return $request->expectsJson() ? null : route('backend.login.view');
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d
    }
}
