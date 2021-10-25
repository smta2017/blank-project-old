<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Contracts\User\IAuth;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{

    /**
     * @var IAuth
     */
    protected $auth;

    /**
     * AuthController constructor.
     * @param IAuth $auth
     */
    public function __construct(IAuth $auth)
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
        return $this->auth = $auth;
    }


    /**
     * Get a TOKEN via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     
     * @OA\post(
     *   path="/auth/login",
     *   tags={"system"},
     *   summary="Login Customer",
     *  
     *   @OA\Response(
     *     response=200,
     *     description="", @OA\JsonContent()
     *   ),
     *
     *
     *   @OA\Parameter(
     *name="email",
     *     in="query",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=100,
     * 
     *         )
     *     ),
     *  
     *   @OA\Parameter(
     *name="password",
     *     in="query",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=100,
     *         ),
     *      style="form"
     *     ),
     *  
     * 
     *    @OA\Parameter(
     *name="firebase_token",
     *     in="query",
     *     required=false,
     *         @OA\Schema(
     *           type="string",
     *         ),
     *      style="form"
     *     ),
     *  
     * 
     * 
     * )
     */

    public function login()
    {
        $credentials = request(['email', 'password']);
        return $this->auth->loginUser($credentials);
    }


    /**
     * Store a newly created resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\post(
     *   path="/auth/register",
     *   tags={"system"},
     *   summary="Register Customer",
     *
     *    @OA\Response(
     *     response=200,
     *     description="", @OA\JsonContent()
     *   ),
     *
     * 
     *   @OA\Parameter(
     *name="name",
     *     in="query",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=100,
     * 
     *         )
     *     ),
     * 
     *   @OA\Parameter(
     *name="email",
     *     in="query",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=100,
     * 
     *         )
     *     ),
     * 
     * 
     * 
     *     @OA\Parameter(
     *name="country_code",
     *     in="query",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=100,
     * 
     *         )
     *     ),
     * 
     * 
     *   @OA\Parameter(
     *name="phone",
     *     in="query",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=100,
     * 
     *         )
     *     ),
     *  
     *   @OA\Parameter(
     *name="password",
     *     in="query",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=100,
     *         ),
     *      style="form"
     *     ),
     *  
     * 
     *   @OA\Parameter(
     *name="firebase_token",
     *     in="query",
     *     required=false,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=200,
     *         ),
     *      style="form"
     *     ),
     *  
     * 
     *  
     *   @OA\Parameter(
     *name="user_type",
     *     in="query",
     *     required=true,
     *         @OA\Schema(
     *           enum={"customer", "specialist"}
     *           type="string",
     *         )
     *     ),
     * 
     * 
     * )
     */

    public function register(RegisterRequest $request)
    {
        return $this->auth->registerUser($request);
    }



    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\post(
     *   path="/auth/me",
     *   tags={"system"},
     *   summary="Authenticated User",
     *   security={{ "apiAuth": {} }}, 
     *
     *    @OA\Response(
     *     response=200,
     *     description="", @OA\JsonContent()
     *   ),
     * 
     * 
     * )
     */

    public function me()
    {
        return ApiResponse::format("sucsess", auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->auth->logout(auth()->user());
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->user()->createToken('')->plainTextToken);
    }

    public function forgotPassword(Request $request)
    {
        return $this->auth->forgotPassword($request);
    }
}
