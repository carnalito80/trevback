<?php
namespace App\Controllers;

use App\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\News;


class NewsController extends Controller
{
   
    public function getNews($number=5) //how many feeds, 5 by default
    {
        
        if (!is_int($number)) return  response()->json(['error' => 'Bad Request'], 400);
       
        if ( Auth::user() ) {
          $news = News::
            orderBy('post_date', 'desc')   // Order by the post date
          ->take($number)                  // Take the first $number
          ->get();

          foreach ($news as $new) {
            //$new->user =   User::find($new->user_id);
              $tempuser =  User::find($new->user_id);
            // $new->user->first_name = 'hej';
            $new->author =  $tempuser->first_name . " " . $tempuser->last_name;
            $new->author_avatar =  $tempuser->avatar;
          }
        
          return  response()->json($news);
        } 
        else return response()->json(['error' => 'Unauthorized'], 401);

    }

}