<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'id';

    protected $fillable = ['imagePath'];
    
    public function hotel(){
        return $this->belongsTo('models/Hotel');
    }



}
