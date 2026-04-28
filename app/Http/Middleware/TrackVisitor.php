<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        // Don't track admin routes or API routes to keep data clean
        if (!$request->is('admin*') && !$request->is('api*') && !$request->ajax()) {
            $ip = $request->ip();
            $date = date('Y-m-d');
            
            // Log visitor once per day per IP
            Visitor::firstOrCreate(
                ['ip_address' => $ip, 'visited_date' => $date],
                ['user_agent' => $request->userAgent()]
            );
        }

        return $next($request);
    }
}
