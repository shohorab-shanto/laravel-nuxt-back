<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninUserRequest;
use App\Http\Requests\SignupUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use HttpResponses;

    public function signup(SignupUserRequest $request)
    {
        $request->validated($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'terms' => $request->terms,
        ]);
        // $user->sendEmailVerificationNotification();

        return $this->success([
            'status' => 'success',
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function signin(SigninUserRequest $request)
    {
        if (isset($request->email)) {
            $request->validated($request->all());
            if (!Auth::attempt($request->only('email', 'password'))) {
                return $this->error([
                    'status' => 'error',
                    'message' => 'Invalid login details'
                ], 401);
            }
        }

        if (isset($request->phone)) {
            $request->validated($request->all());
            if (!Auth::attempt($request->only('phone', 'password'))) {
                return $this->error([
                    'status' => 'error',
                    'message' => 'Invalid login details'
                ], 401);
            }
        }

        $user = Auth::user();
        $token = $user->createToken('API Token of ' . $user->name)->plainTextToken;
        $user = UserResource::make($user);

        return $this->success([
            'status' => 'success',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout()
    {

        $token = auth()->user()->currentAccessToken();
        $token->delete();

        return $this->success([
            'status' => 'success',
            'message' => 'Logged out successfully',
        ]);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'hash' => 'required|string'
        ]);

        $user = User::findOrFail($request->id);

        if ($user->hasVerifiedEmail()) {
            return $this->error([
                'status' => 'error',
                'message' => 'Email already verified.'
            ], 400);
        }

        if ($user->markEmailAsVerified()) {
            $message = 'Email verified successfully.';
            return redirect()->away(env('FRONTEND_URL') . '/auth')->with('success', $message);
        }

        return $this->error([
            'status' => 'error',
            'message' => 'Email verification failed.'
        ], 400);
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->error([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return $this->error([
                'status' => 'error',
                'message' => 'Email already verified.'
            ], 400);
        }

        $user->sendEmailVerificationNotification();

        return $this->success([
            'status' => 'success',
            'message' => 'Email verification link sent successfully.'
        ]);
    }
}
