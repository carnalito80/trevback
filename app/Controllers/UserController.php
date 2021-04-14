<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\User;

class UserController extends Controller
{
   
    public function show($id)
    {
        $userz = User::findOrFail($id);

        $cars = User::find($id)->cars; //get the cars tied to the company
        $cararray = [];
        foreach ($cars as $car) {
            array_push( $cararray, $car);
          
        }
        $userz->cars = $cararray;
      
        return $userz;
    }


    
}