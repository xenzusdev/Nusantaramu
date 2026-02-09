<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIoTSecret
{
    public function handle(Request $request, Closure $next): Response
    {
        $validSecret = env('IOT_SECRET_KEY');

        $clientSecret = $request->header('X-IoT-Secret');

        if (!$clientSecret || $clientSecret !== $validSecret) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses Ditolak. Kunci API Salah atau Tidak Ada.'
            ], 403); // 403 Forbidden
        }

        return $next($request);
    }
}