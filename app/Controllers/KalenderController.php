<?php
namespace App\Controllers;


use App\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\KalenderEvent;
use DateTime;



class KalenderController extends Controller
{


    public function getEvents(Request $request)  // här kör vi get variablar
    {
        
            
        if ( Auth::user() ) {
          $events = KalenderEvent::
            orderBy('startDate', 'desc')   // Order by the post date
          ->get();

         
          return  response()->json($events);
        } 
        else return response()->json(['error' => 'Unauthorized'], 401);

    }

    public function createEvent(Request $request)  // variablar från post ligger i $request
    {
      
        if ( Auth::user() ) {
          $thedata  = $request->all()['event'];
           $event = new KalenderEvent;

            $event->ownerId = Auth::user()->id;
            $event->title = $thedata['title'];
            $event->startDate = $this->convTime($thedata['startDate']);
            $event->endDate =  $this->convTime($thedata['endDate']);
            if ( strlen($thedata['info']) > 0)  $event->info = $thedata['info'];
            $event->behov = $thedata['behov'];
            $event->save();
         
          return  response()->json($event, 201);
        } 
        else return response()->json(['error' => 'Unauthorized'], 401);

    }

    public function editEvent($id=0, Request $request)  
    {
      if ($id == 0) return response()->json(['error' => 'Bad Request'], 400);
  
        if ( Auth::user() ) {
            $letsgo = 0;
            $thedata  = $request->all()['event'];
            $event = KalenderEvent::find($id);
            if ($thedata['ownerId'] == Auth::user()->id && $thedata['ownerId'] == $event->ownerId) $letsgo = 1; //vi kollar bara ownerId just nu, sedan kan vi hooka på företag osv.. 
            // else if kolla annat som generar $letsgo = 1.
            if ($letsgo == 1) {
            $event->title = $thedata['title'];
            $event->startDate = $this->convTime($thedata['startDate']);
            $event->endDate =  $this->convTime($thedata['endDate']);
            if ( strlen($thedata['info']) > 0)  $event->info = $thedata['info'];
            $event->behov = $thedata['behov'];
            $event->save();
            return  response()->json($event, 201);
            }
            else  return response()->json(['error' => 'Forbidden'], 403);
        } 
        else return response()->json(['error' => 'Unauthorized'], 401);

    }

    public function removeEvent($id=0)  
    {
      if ($id == 0) return response()->json(['error' => 'Bad Request'], 400);
  
        if ( Auth::user() ) {
            $letsgo = 0;
            $event = KalenderEvent::find($id);
            if (Auth::user()->id == $event->ownerId) $letsgo = 1; //vi kollar bara ownerId just nu, sedan kan vi hooka på företag osv.. 
            // else if kolla annat som generar $letsgo = 1.
            if ($letsgo == 1) {
            $event->delete();
            return  response()->json($id, 200);
            }
            else return response()->json(['error' => 'Forbidden'], 403);
        } 
        else return response()->json(['error' => 'Unauthorized'], 401);

    }



    protected function convTime($time) {
      // Instantiate a DateTime with microseconds.
      $d = new DateTime($time);
      
      // Output the date without microseconds.
      return $d->format('Y-m-d H:i:s'); // 2011-01-01T15:03:01.012345
      }

}

 // Get event from post data
//   const event = JSON.parse(request.data).event

//   const length = data.events.length
//   let lastIndex = 0
//   if (length) {
//     lastIndex = data.events[length - 1].id
//   }
//   event.id = lastIndex + 1

//   data.events.push(event)

//   return [201, {id: event.id}]