<?php

namespace App\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login']]);
    }


   
    public function register(Request $request) {
         //echo $request;
         if (!$request->first_name ) return response()->json(['error' => 'First name is missing'], 400);
         if (!$request->last_name ) return response()->json(['error' => 'Last name is missing'], 400);
         if (!$request->email ) return response()->json(['error' => 'email is missing'], 400);
         if (!$request->password ) return response()->json(['error' => 'password is missing'], 400);
         if ($request->info != '' ) return response()->json(['ok' => 'All good in the hood'], 200); // hopefully the bots fall for this one


         //if (!$request->recaptcha)  return response()->json(['error' => 'Please enter the reCAPTCHA!'], 403);
         $userinfo = [];
         $userinfo['first_name'] = $request->first_name;
         $userinfo['last_name'] = $request->last_name;
         $userinfo['email'] = $request->email;
         $userinfo['password'] = Hash::make($request->password);
         $userinfo['role_id'] = 6;
         $userinfo['address'] = '';
         $userinfo['phonenumber'] = '';
         $userinfo['status'] = 'not_confirmed';

        

         try {
         User::create($userinfo);
         return response()->json(['ok' => 'user created'], 201);
          } catch(\Illuminate\Database\QueryException $ex){ 

                $themessage = $ex->getMessage();
                 if (strpos($themessage,"1062 Duplicate entry")) return  response()->json(['error' => "user already exists" ], 406);
            return  response()->json(['error' => "unknown server error" ], 500);
        }
       
    }



    // async register(req, res) {
    //     try {
    //       if (!req.body.recaptcha) {
    //         res.status(403).send({
    //           error: 'Please enter the reCAPTCHA!',
    //         });
    //       }
    //       const user = await User.create(req.body.credential);
    //       const userJson = user.toJSON();
    //       delete userJson.password;
    //       res.send({
    //         user: userJson,
    //         token: jwtSignUser(userJson),
    //       });
    //     } catch (err) {
    //       res.status(400).send({
    //         error: 'The email account is already in use...',
    //       });
    //     }
    //   },


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        
        
        //$credentials = request(['email', 'password']);
        $credentials = $request->only(['email', 'password']);
        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Wrong User or Password'], 401);
        }
        $publicUserInfo = $this->getPublicUserInfo(Auth::user());
        return $this->respondWithTokenAndUser($token,$publicUserInfo);
    }

    /**
     * Get the authenticated User.
     *
     */
    public function me()
    {
        if ( Auth::user() ) {
            $user = Auth::user();
            $user->userRole = Auth::user()->role->name;
            $user->company = Auth::user()->company->name;
            return $user;
        } 
        else return response()->json(['error' => 'Unauthorized'], 401);
        
        //return Auth::user();

    }

   

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }


    public function patchRefresh()
{
    $current_token  = Auth::getToken();
    $token          = Auth::refresh($current_token);


    return response()->json([
        'accessToken' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
    ]);
    // return response()->json([
    //     "status" => "success",
    //     "code" => 200,
    //     'data' =>
    //         compact('token'),
    //     'messages' => ['Token refreshed!'],
    // ]);
}

    /**
     * Returns the data we want on the user.
     *
     */
    protected function getPublicUserInfo($user) {
            $user->userRole = Auth::user()->role->name;
            if (Auth::user()->company && Auth::user()->company->name) $user->company = Auth::user()->company->name;
            return $user;

    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'accessToken' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    protected function respondWithTokenAndUser($token, $user)
    {
        return response()->json([
            'accessToken' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'userData' => $user
        ]);
    }
}