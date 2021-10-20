<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;
use Carbon\Carbon;

class SocialAuthController extends Controller
{
    public function facebookLogin()
    {
        return Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl();
    }

    public function facebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();

            $createUser = User::firstOrCreate([
                'facebook_id' => $user->id
            ], [
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => Carbon::now()->toDateTimeString(),
                'facebook_id' => $user->id,
                'password' => encrypt('admin@123')
            ]);
            $token = $createUser->createToken('token-name')->plainTextToken;

            return \response()->json(['access_token' => $token, 'token_type' => 'bearer'], 200);
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    //google
    public function googleLogin()
    {
        return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            $createUser = User::firstOrCreate([
                'google_id' => $user->id
            ], [
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => Carbon::now()->toDateTimeString(),
                'google_id' => $user->id,
                'password' => encrypt('admin@123')
            ]);
            $token = $createUser->createToken('token-name')->plainTextToken;

            return \response()->json(['access_token' => $token, 'token_type' => 'bearer'], 200);
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
