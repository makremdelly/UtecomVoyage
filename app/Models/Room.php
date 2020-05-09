<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'total', 'vue', 'persons', 'surface', 'description'];

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }

    public function reservations()
    {
        return $this->belongsToMany('App\Models\Reservation','reservations_has_rooms','room_id','reservation_id');
    }

    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }

    public function equipments()
    {
        return $this->hasMany('App\Models\Equipment');
    }

}
