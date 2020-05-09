<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Payment extends Model
{
    use SoftDeletes,SoftCascadeTrait;
    
    protected $softCascade = ['reservation'];

    public function reservation()
    {
        return $this->hasOne('App\Models\Reservation');
    }
}
