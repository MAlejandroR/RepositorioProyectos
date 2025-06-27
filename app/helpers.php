<?php
use Illuminate\Support\Facades\Log;


if (!function_exists('debugAuthAdmin')) {
    function debugAuthAdmin(string $mesage): void
    {
        if (app()->environment('local')&&config('app.debug_auth_admin'))
            Log::info($mesage);
    }
}

if (!function_exists('debugMiddlewareInertia')) {
    function debugMiddlewareInertia(string $mesage): void
    {
        if (app()->environment('local')&& config('app.debug_middleware_inerta'))
            Log::info($mesage);
    }
}

