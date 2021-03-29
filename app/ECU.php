<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECU extends Model
{
    use HasFactory;

      /**
     * Get the cars that has this ECU version.
     */
    public function cars()
    {
        return $this->belongsTo('App\Car');
    }
}
