<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Hotel extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;
    protected $fillable = ['name','phone'];


    public function users()
    {
        return $this->belongsToMany('App\Models\User','users_has_hotels','hotel_id','user_id');
    }
    
    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }

    public function reservations()
    {
        return $htis->hasMany('App\Models\Reservation');
    }

    public function services()
    {
        return $htis->hasMany('App\Models\Service');
    }

    public function histories()
    {
        return $htis->hasMany('App\Models\History');
    }

}
