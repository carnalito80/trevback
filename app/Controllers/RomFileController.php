<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Company;
use App\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class RomFileController extends Controller
{
   
    public function postECU(Request $request) {

      //  if ( !Auth::user() )  return  response()->json(['error' => 'Unauthorized'], 401);
        $userid  = 100; //obviously this will be fetched from Auth::user() but this is for test.
      
        if (!Storage::disk('ecudisk')->exists($userid)) Storage::disk('ecudisk')->makeDirectory($userid); //if the customers folder does not exist. create it.

        //our input here... comes from the app in form of a post from a wizard
        $torque = $request->input('torque');
        $throttle = $request->input('throttle');
        $whatever =  $request->input('whatever');
             
        
        // lets run your command
        // uses https://symfony.com/doc/current/components/process.html#using-features-from-the-os-shell
        // permissions needs to be set in place of course
  
         $process = new Process(['/path/to/your/programcommand', '-torque', $torque, '-throttle',  $throttle, '-whatever', $whatever, '-customer', $userid]);
         $process->run();
       
        // this if needs to be the other way around of course.. :)
        if ($process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        else { 
           
            //lets pretend you program generated a rom file and meta file with id 2121, in this case they are already there.
            $file_id = '2121';
            $meta = Storage::disk('ecudisk')->get('/' . $userid . '/' . $file_id . '.json');
            var_dump($meta);
        }
    }    
    
}