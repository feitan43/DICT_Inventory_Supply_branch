<?php

namespace App\Http\Middleware;

use Closure;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;

class VerifyCaptcha
{
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('POST')) {
            $captcha = $request->input('captcha');
            if (!$captcha) {
                return redirect()->back()->withErrors(['captcha' => 'Please enter the CAPTCHA']);
            }

            if (!Session::get('captcha') || !hash_equals(Session::get('captcha'), $captcha)) {
                return redirect()->back()->withErrors(['captcha' => 'Invalid CAPTCHA']);
            }
        }

        return $next($request);
    }
}
