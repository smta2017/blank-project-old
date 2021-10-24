<?php

namespace App\Repositories\Eloquent\User;

use App\Helpers\ApiResponse;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\User\IAuth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class AuthRepository
 */
class AuthRepository extends BaseRepository implements IAuth
{

    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }


    /**
     * @param $request
     * @return Application|ResponseFactory|Response
     */
    public function loginUser($request)
    {
        if (!$token = auth()->attempt($request)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return  ApiResponse::format("success", $this->respondWithToken(auth()->user()->createToken('')->plainTextToken));
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function registerUser($request): JsonResponse
    {
        $user = $this->create(array_merge(
            $request->all(),
            ['password' => Hash::make($request->password)],
        ));

        $user->sendEmailVerificationNotification();
        return  ApiResponse::format("success", $user);
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function changePassword($request): JsonResponse
    {
        return \response()->json("ok");
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return  ApiResponse::format("success",'Email sent.');
    }
    public function resetView(Request $request)
    {
        return \view('auth.reset-password');
    }

    public function reset(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return \view("auth.succses-reset-password");
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function verifyEmail($request): JsonResponse
    {
        return \response()->json($request);
    }
    /**
     * @param $request
     * @return JsonResponse
     */
    public function verifiedPhone($request): JsonResponse
    {
        return \response()->json("ok");
    }

    /**
     * Send OTP for user for verification
     * @param $request
     * @return JsonResponse
     */
    public function sendCode($request): JsonResponse
    {
        return \response()->json("ok");
    }



    public function verifyCode($request)
    {
        return \response()->json("ok");
    }


    /**
     * @return JsonResponse
     */
    public function getProfile(): JsonResponse
    {
        return \response()->json("ok");
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function editProfile($request): JsonResponse
    {
        return \response()->json("ok");
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function logout($request): JsonResponse
    {
        return \response()->json("ok");
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function updateDeviceToken($request): JsonResponse
    {
        return \response()->json("ok");
    }
}
