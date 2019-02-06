<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;
use Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(){
        // $this->middleware('auth:api',['except'=>['login']]);
    }

    /**
     *  Authenticate a user based on email and password
     *
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     **/
    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        // attempt to verify the credentials and create a token for the user
        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // all good so return the token
        return $this->respondWithToken($token);
    }

    /**
     * Get Authenticated Users
     *
     * @return \Illuminate\Http\JsonResponse
     **/
    public function getAuthenticatedUser()
    {       
        return response()->json(Auth::user());
    }

    /**
     * creates a new user
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     **/
    public function register(Request $request)
    {
        $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6',
        ]);
        $user = User::create($request->all());
        //user has to login after registeration OR ?!
        $token = Auth::login($user);
        return $this->respondWithToken($token);
    }

    /**
     * Refresh Auth token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(){
        $token = Auth::refresh();
        return $this->respondWithToken($token);
    }

    /**
     * Log out user - Invalidate Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        Auth::logout();
        return response()->json(['message'=>'successfully Logged Out User']);
    }

    /**
     * Helper function for returning accesstoken, token type and expires in
     * 
     * @param String $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>Auth::factory()->getTTL() * 60
        ]);
    }
}
