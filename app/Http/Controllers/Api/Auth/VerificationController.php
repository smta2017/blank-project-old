<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\User\IAuth;
use Illuminate\Http\Request;

class VerificationController extends Controller
{

    /**
     * @var IAuth
     */
    protected $auth;

    public function __construct(IAuth $auth)
    {
        return $this->auth = $auth;
    }


    public function verifyEmail($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return $this->respondUnAuthorizedRequest(253);
        }
        $user = User::findOrfail($user_id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        return $user;
    }
}
