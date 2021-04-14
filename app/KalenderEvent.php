<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalenderEvent extends Model
{
    use HasFactory;

    /**
     * Hämtar användaren som äger eventet.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'ownerId');
    }

    
}
