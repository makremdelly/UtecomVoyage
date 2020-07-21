<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Voyage extends Model implements HasMedia
{

    use  HasMediaTrait; 

    protected $table = 'voyages';
    protected $primaryKey = 'id';
    protected $fillable = ['type','NbPlace','villeD','depart','retour','prix','startDate','endDate','photo','description'];

    public function hotel(){
        return $this->hasMany('models/Hotel');
    }
    // public function autocar(){
    //     return $this->hasMany('models/Autocar');
    // }
    public function autocar()
    {
        return $this->hasOne('App\Models\Autocar');
    }
    public function reservations()
    {
        return $this->belongsToMany('App\Models\Reservation','voyages_has_reservations','voyage_id','reservation_id');
    }
}
