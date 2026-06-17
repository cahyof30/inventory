<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecaptchaService
{
    public static function verify(string $token): bool
    {
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $token,
            ]
        );

        if (! $response->successful()) {
            return false;
        }

        $result = $response->json();

        return $result['success']
            && ($result['score'] ?? 0) >= 0.5;
    }
}