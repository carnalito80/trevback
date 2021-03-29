<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Company;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
   
    //get all companies
    public function getCompanies()
    {
       
            $companies = Company::all();
            if (!$companies) return response()->json(['error' => 'Not Found'], 404); 
            else return $companies;
        
        
    }

    //test function to show user.
    public function show($id)
    {
        $userz = User::findOrFail($id);
        return $userz;
    }

    // Get user by ID, if no ID specified get all users.
    public function getUsers($which ='all') { 

        if ($which == 'all') {

            $users = User::all();
       
            foreach ($users as $user) {
                $user->company;
                $user->role;
                $user->cars;
            

            }
            return $users;
        }
        else {
            $user = User::find($which);
            if (!$user) return response()->json(['error' => 'Not Found'], 404); 
            else {
            $user->company;
            $user->role;
            $user->cars;
            return $user;
            }
        }
        
        return response()->json(['error' => 'General Error'], 400); 
    }

    //Get the different user roles
    public function getRoles() {
        $roles = Role::all();
        return $roles;
    }

    //remove a specific user.
    public function removeUser($which) {

        $user = User::find($which);
        if (!$user) return response()->json(['error' => 'Not Found'], 404);
        elseif ($user->role->name == 'superadmin')  return response()->json(['error' => 'Unauthorized'], 401); // superadmin accounts cannot be deleted this way.
        else $user->delete();
    }
    
}