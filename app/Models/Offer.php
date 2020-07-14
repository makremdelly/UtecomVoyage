<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }
    public function voyage()
    {
        return $this->belongsTo('App\Models\Voyage');
    }
}
