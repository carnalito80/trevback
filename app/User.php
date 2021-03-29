<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;


    // JWT Stuff

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    // default values
    protected $attributes = [
        'status' => 0,
        'role_id' => 6,
        'address' => '',
        'phonenumber' => '',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','email', 'password', 'address','phonenumber',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'last_ip', 'updated_at', 'role_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the role record associated with the user.
     */
    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    //public $userRole = $this->role();

    /**
     * Get the customer record associated with the user.
     */
    public function company()
    {
        return $this->hasOne('App\Company', 'id', 'company_id');
    }
    /**
     * Get the cars for the user.
     */
    public function cars()
    {
        return $this->hasMany('App\Car');
    }

   
    
}
