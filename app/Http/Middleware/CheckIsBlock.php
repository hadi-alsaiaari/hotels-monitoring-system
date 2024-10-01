<?php

namespace App\Http\Middleware;

use App\Models\HotelUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user('web');
        if ($user instanceof HotelUser){// && $user->user_of_hotel_type == 'App\Models\HotelOwner') {
            $owner_hotel = $user->user_of_hotel()->first();
            if ($user->user_of_hotel_type == 'App\Models\HotelOwner') {
                $hotel = $owner_hotel->hotel();
            } else {
                $hotel = $owner_hotel->hotel;
            }
            if($hotel->status == 'block'){
                return redirect()->route('block', $hotel);
            }
        }

        return $next($request);
    }
}
