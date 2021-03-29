<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo', 'phone', 'email', 'website', 'country', 'type', 'billing_adress', 'tax', 'num_employees', 'reputation'
    ];
    protected $hidden = [
        'hashed'
    ];

    /**
     * Get the cars for the company.
     */
    public function cars()
    {
        return $this->hasMany('App\Car');
    }

}
