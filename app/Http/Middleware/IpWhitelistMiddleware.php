<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IpWhitelistMiddleware
{
    /**
     * Define allowed IPs (In real enterprise app, fetch from DB or config).
     * Only these static IPs are allowed for Warehouse/Delivery managers.
     */
    protected $allowedIps = [
        '127.0.0.1', 
        '::1', 
        '192.168.1.100', // Example Warehouse WiFi Static IP
        '10.0.0.5'
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && in_array(Auth::user()->role, ['warehouse', 'delivery'])) {
            if (!in_array($request->ip(), $this->allowedIps)) {
                \Illuminate\Support\Facades\Log::warning('Unauthorized IP Access Attempt', [
                    'ip' => $request->ip(),
                    'user_id' => Auth::id()
                ]);
                abort(403, 'Unauthorized. Access restricted to approved Warehouse network IPs only (Enterprise Policy).');
            }
        }

        return $next($request);
    }
}
