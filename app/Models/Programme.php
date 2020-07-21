<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Programme extends Model
{
    use SoftDeletes;

    protected $table = 'programmes';
    protected $fillable = ['Programme','created_at','voyage_id'];

    public function voyage(){
        return $this->belongsTo('App\Models\Voyage');
    }
}
