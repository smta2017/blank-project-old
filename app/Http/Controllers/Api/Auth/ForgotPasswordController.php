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

    /**
     * send reset password email.
     *
     * @return \Illuminate\Http\JsonResponse
     
     * @OA\post(
     *   path="/auth/forgot-password",
     *   tags={"system"},
     *   summary="Forget password",
     *  
     *   @OA\Response(
     *     response=200,
     *     description="", @OA\JsonContent()
     *   ),
     * 
     * 
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="application/json",
     *        @OA\Schema(
     *             example= {"email":"name@email.com"}
     *                 )
     *             )
     *         ),
     * 
     * )
     */

    public function forgotPassword(Request $request)
    {
        return $this->auth->forgotPassword($request);
    }


    public function resetView(Request $request)
    {
        return $this->auth->resetView($request);
    }

    public function resetPassword(Request $request)
    {
        return $this->auth->resetPassword($request);
    }
}
