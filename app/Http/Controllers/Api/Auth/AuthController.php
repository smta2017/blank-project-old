<?php

namespace App\Http\Controllers\Api\Auth;

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

    public function login()
    {
        $credentials = request(['email', 'password']);
        return $this->auth->loginUser($credentials);
    }

    public function register(RegisterRequest $request)
    {
        return $this->auth->registerUser($request);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
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
