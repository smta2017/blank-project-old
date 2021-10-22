<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\User\IAuth;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
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
        return $this->auth = $auth;
    }

    public function forgotPassword(Request $request)
    {
        return $this->auth->forgotPassword($request);
    }

    
    public function resetView(Request $request)
    {
        return $this->auth->resetView($request);
    }

    public function reset(Request $request)
    {
        return $this->auth->reset($request);
    }
}
