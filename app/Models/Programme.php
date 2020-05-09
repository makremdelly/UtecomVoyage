<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Programme extends Model
{
    protected $table = 'programmes';
    protected $fillable = ['Date', 'Programme','created_at','voyage_id'];

    public function voyage(){
        return $this->belongsTo('App\Models\Voyage');
    }
}
