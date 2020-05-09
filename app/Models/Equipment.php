<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = ['name', 'room_id'];
    
    public function room() {
        return $this->belognsTo('App\Models\Room');
    }
}
