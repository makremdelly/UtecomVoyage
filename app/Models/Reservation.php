<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Payment;

class Reservation extends Model
{
    use SoftDeletes;

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }

    public function rooms()
    {
        return $this->belongsToMany('App\Models\Room','reservations_has_rooms','reservation_id','room_id');
    }
}
