<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable,HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name','email', 'password','phone','picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hotels()
    {
        return $this->belongsToMany('App\Models\Hotel','users_has_hotels','user_id','hotel_id');
    }

    public function subscription()
    {
        return $this->hasOne('App\Models\Subscription');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function role()
    {
        return $this->belongsTo('App\Role'); // apply your namespace accordingly
    }
}
