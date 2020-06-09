<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Room extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['name', 'total', 'vue', 'persons', 'surface', 'description', 'type'];

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
