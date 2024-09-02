<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class TrackVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $today = Carbon::now();
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $agent = new Agent();
        $browser = $agent->browser();
        $visit = Visit::where('ip_address', $ipAddress)->whereDate('created_at', $today)->first();
        if (!$visit) {

            Visit::create([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'browser' => $browser,
                'activity' => now(),
                'last_activity' => now(),
            ]);
        } else {

            $visit->last_activity = now();
            $visit->save();
        }


        return $next($request);
    }
}
