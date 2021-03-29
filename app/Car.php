<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


        
    /**
     * Get the ECUs linked to the car
     */
    public function ecus()
    {
        return $this->hasMany('App\ECU');
    }
    /**
     * Get the company that owns the car.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    /**
     * Get the user that owns the ccar.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

     /**
     * Get the model of the car.
     */
    public function model()
    {
        return $this->hasOne('App\CarModel', 'id', 'model_id');
    }


    protected $fillable = ['name', 'color','chassinumber','year'];
}
