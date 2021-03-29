<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{

      /**
     * News flashes
     */
    protected $fillable = [
        'title', 'text', 'picture', 'post_date'
    ];

  
}
