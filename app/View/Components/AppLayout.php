<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        if(Config::get('fortify.guard') =='security_department_office'){
            return view('security_department_office.layouts.app');
        }
        elseif(Config::get('fortify.guard') =='tourist_police'){
            return view('tourist_police.layouts.app');
        }
        elseif(Config::get('fortify.guard') =='tourism_office'){
            return view('tourism_office.layouts.app');
        }
        return view('hotels.layouts.app');
    }
}
