<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class VerifyRecaptcha
{
    public function handle(Request $request, Closure $next)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        $body = $response->json();
        if (!$body['success']) {
            return back()->with('error', 'reCAPTCHA không hợp lệ. Vui lòng thử lại.');
        }

        return $next($request);
    }
}
