<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autocar extends Model
{
     protected $table = 'autocars';
    protected $primaryKey = 'id';
    protected $fillable = ['type','NbPlace','Matricule','status'];

    public function voyage(){
        return $this->belongsTo('App\Models\voyage');
    }
}
