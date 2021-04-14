<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Company;
use App\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;



class CompanyController extends Controller
{
   
    public function getCompany($id=0)
    {
        if (!Auth::user()) return response()->json(['error' => 'Not Logged in'], 400); // if not logged in

        if ($id === 0 && Auth::user()->company_id) {
            $id = Auth::user()->company_id; //if this function is called with no specific company get get the company tied to user
            $company = Company::find($id);
        }    
        else if ( Auth::user()->company_id === $id) { //get the company tied to user... Obviously we want to nip this up further with different user types etc
            $company = Company::find($id);
          
        }
        else return response()->json(['error' => 'Unauthorized'], 401);

        
        if ($company->logo == '' || $company->logo == 'default' ) $company->logo = 'defaultlogo.jpg'; // set the default logo

        $cars = Company::find($id)->cars; //get the cars tied to the company
        $cararray = [];
        $ecuarray = [];
        foreach ($cars as $car) {
            array_push( $cararray, $car);
            $currentecus =  Car::find($car->id)->ecus;
            foreach ($currentecus as $ecu) {
                if (!empty($ecu)) array_push( $ecuarray, $ecu);
            }
            
        }
        $company->cars = $cararray;
        $company->ecus = $ecuarray;

    return $company; //return the company
    }

    public function updateCompanyDetails($id=0,Request $request) {
        if ($id === 0 && Auth::user()->company_id) {
            $id = Auth::user()->company_id; //if this function is called with no specific company get get the company tied to user
            $company = Company::find($id);
        }    
        else if ( Auth::user()->company_id === $id) { //get the company tied to user... Obviously we want to nip this up further with different user types etc
            $company = Company::find($id);
          
        }
        else return response()->json(['error' => 'Unauthorized'], 401); //well fuck off then. :D

          $input = $request->all();
          $company->fill($input)->save();
          return 'Record Successfully Updated!';

        return  response()->json($company);

    }    

    public function uploadLogo($id=0,Request $request) {
        
        if ($id === 0 && Auth::user()->company_id) {
            $id = Auth::user()->company_id; //if this function is called with no specific company get get the company tied to user
            $company = Company::find($id);
        }    
        else if ( Auth::user()->company_id === $id) { //get the company tied to user... Obviously we want to nip this up further with different user types etc
            $company = Company::find($id);
          
        }
        else return response()->json(['error' => 'Unauthorized'], 401); //well fuck off then. :D

            //some validation
            $size = $request->file->getSize();
            $mimetype = $request->file->getMimeType();
            $filename = $request->file->getClientOriginalName();

            if ($size > 810000) return response()->json(['error' => 'File too big'], 413);
            if ($mimetype != "image/jpeg" && $mimetype != "image/png" ) return response()->json(['error' => 'Only images supported (jpg, gif, png)'], 415);
           
            //store the image
           
            $path = $request->file->storeAs('img/company/', $filename,'public');
            //save the image
            $company->logo = $filename;
            $company->save();

         return 'OK, ' . $filename . ' saved';
       
     }

   
}