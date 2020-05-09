<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function room()
    {
        return $this->hasOne('App\Models\Room');
    }
}
