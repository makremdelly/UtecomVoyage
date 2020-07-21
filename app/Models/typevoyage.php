<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typevoyage extends Model
{
    public function voyages()
    {
        return $this->belongsToMany('App\Models\Voyage');
    }}
