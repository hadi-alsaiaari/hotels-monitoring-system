<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ListHotels extends Component
{
    public $list_hotels;
    /**
     * Create a new component instance.
     */
    public function __construct($count = 10)
    {
        $user = Auth::user();
        $hotel_owner = $user->user_of_hotel;
        
        $this->list_hotels = $hotel_owner->hotels;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.list-hotels',[$this->list_hotels]);
    }
}
