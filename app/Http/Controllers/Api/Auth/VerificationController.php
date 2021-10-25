<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Traits\SMSTrait;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use SMSTrait;

     /**
     * send phone OTP.
     *
     * @return \Illuminate\Http\JsonResponse
     
     * @OA\get(
     *   path="/verify/send-otp/{phone_number}",
     *   tags={"system"},
     *   summary="send OTP",
     *  
     *   @OA\Response(
     *     response=200,
     *     description="send OTP", @OA\JsonContent()
     *   ),
     *
     *   @OA\Parameter(
     *name="phone_number",
     *     in="path",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=15,
     *         )
     *     ),
     *  
     * 
     * )
     */
    public function sendMobileOTP($phone_number)
    {
        $res =  $this->sendOTP($phone_number);
        return  ApiResponse::format("success", $res);
    }

    /**
     * verify phone OTP.
     *
     * @return \Illuminate\Http\JsonResponse
     
     * @OA\get(
     *   path="/verify/confirm-otp/{phone_number}/{otp}",
     *   tags={"system"},
     *   summary="OTP verifitation",
     *  
     *   @OA\Response(
     *     response=200,
     *     description="OTP verifitation", @OA\JsonContent()
     *   ),
     *
     *   @OA\Parameter(
     *name="phone_number",
     *     in="path",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=15,
     *         )
     *     ),
     * 
     *   @OA\Parameter(
     *name="otp",
     *     in="path",
     *     required=true,
     *         @OA\Schema(
     *           type="string",
     *           maxLength=15,
     *         )
     *     ),
     *  
     * 
     * )
     */
    public function confirmOTP($phone_number, $otp)
    {
        $res =  $this->verifyOTP($phone_number, $otp);
        if ($res->valid==true) {
            return  ApiResponse::format("success", $res);
        }else{
            return  ApiResponse::format("fail", $res,false);
        }
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
        return  ApiResponse::format("success", $user);
    }
}
