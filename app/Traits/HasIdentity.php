<?php

namespace App\Traits;

trait HasIdentity
{
    public function identity(){
        return $this->morphOne('App\Models\Identity', 'person');
    }
}