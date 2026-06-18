<?php

namespace App\Services;

use Illuminate\Support\Facades\RateLimiter;

class RateLimitService
{
    public static function check(string $ip): bool
    {
        $key = "search:{$ip}";

        if (RateLimiter::tooManyAttempts($key, 30)) {
            return false;
        }

        RateLimiter::hit($key, 60);

        return true;
    }
}