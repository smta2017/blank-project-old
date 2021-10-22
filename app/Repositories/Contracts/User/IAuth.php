<?php

namespace App\Repositories\Contracts\User;

use App\Repositories\Contracts\IBase;
use Illuminate\Http\Request;

/**
 * Interface IAuth
 */
interface IAuth extends IBase
{
    
    /**
     * @param $request
     * @return mixed
     */
    public function loginUser($request);

    /**
     * @param $request
     * @return mixed
     */
    public function registerUser($request);

    /**
     * @param $request
     * @return mixed
     */
    public function changePassword($request);

    /**
     * @param $request
     * @return mixed
     */
    public function forgotPassword(Request $request);


    public function resetView(Request $request);
    
    public function reset(Request $request);


    public function sendCode($request);

    /**
     * @param $request
     * @return mixed
     */
    public function verifiedPhone($request);

    /**
     * @param $request
     * @return mixed
     */
    public function verifyEmail($request);

    /**
     * @param $request
     * @return mixed
     */
    public function verifyCode($request);

    /**
     * @return mixed
     */
    public function getProfile();

    /**
     * @param $request
     * @return mixed
     */
    public function editProfile($request);

    /**
     * @param $request
     * @return mixed
     */
    public function logout($request);

    /**
     * @param $request
     * @return mixed
     */
    public function updateDeviceToken($request);
}
