<?php

namespace App\Http\Middleware\Api;

use App\Models\HotelReceptionist;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsReceptionistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user->user_of_hotel_type !== HotelReceptionist::class) {
            return response()->json(['data'=>'Unauthorize this action',405, 'status'=>'Fail']);
        }

        return $next($request);
    }
}
