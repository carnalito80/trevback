<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $hidden = [
        'id', 'description', 'created_at', 'updated_at'
    ]; 
    protected $guarded = [
        'name', 'displayname',
    ]; 
}
