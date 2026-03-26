<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBusinessProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): \Symfony\Component\HttpFoundation\Response
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            $user = \Illuminate\Support\Facades\Auth::user();
            
            // Define mandatory fields for business/admin
            $mandatoryFields = ['business_name', 'gstin', 'business_phone', 'business_address'];
            $needsProfile = false;

            if ($user->role === 'admin') {
                foreach ($mandatoryFields as $field) {
                    if (empty($user->$field)) {
                        $needsProfile = true;
                        break;
                    }
                }
            }

            if ($needsProfile) {
                // Allow access to settings, profile edit (for password), and logout
                if (!$request->routeIs('settings.*') &&
                    !$request->routeIs('profile.*') &&
                    !$request->routeIs('logout') &&
                    !$request->routeIs('logout.get')) {
                    
                    return redirect()->route('settings.business')
                        ->with('warning', '⚠️ Action Required: Please complete your Business Profile (GST, Address, etc.) to access the dashboard.');
                }
            }
        }

        return $next($request);
    }
}
