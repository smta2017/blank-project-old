<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;

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
                'email_verified_at' => now(),
                'facebook_id' => $user->id,
                'password' => encrypt('admin@123')
            ]);
            $token = $createUser->createToken('token-name')->plainTextToken;

            return \response()->json(['access_token' => $token, 'token_type' => 'bearer'], 200);
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
