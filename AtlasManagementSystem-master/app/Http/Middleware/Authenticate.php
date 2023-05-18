<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // 2023.05.17 web.phpの->name('loginView');のloginViewと
            // return route('loginView');のloginViewを連動させるとloginページにリダイレクトできる
            return route('loginView');
        }
    }
}