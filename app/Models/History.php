<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }

    public function subscription()
    {
        // return $this->belongsTo('App\Models\Subscription');
        return $this->belongsTo('App\Models\Reservation');

    }
}
