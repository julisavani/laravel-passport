<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\SocialLoginRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    
    /**
     * Handle an incoming register request.
     */
    public function register(Request $request) //RegisterRequest
    {
        $data = $request->all();
        if ($request->profile_image) {
            $data['profile_image'] = $request->profile_image->store('profile-images');
        }
        $user = User::create($data);
        return new UserResource($user);
    }
    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, "error" => $this->validationMessage($validator->errors()->toArray())], 422);
        }
        if (Auth::attempt($request->all())) {
            // successfull authentication
            $user = User::find(Auth::user()->id);
            return response()->json([
                'token' => $user->createToken('appToken')->accessToken,
                'user' => new UserResource($user),
            ], 200);
        } else {
            // failure to authenticate
            return response()->json([
                'error' => 'Invalid Email or Password.',
                'status' => false,
            ], 401);
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function socialLogin(Request $request)//SocialLoginRequest
    {
        if (Auth::attempt(['provider_name' => $request->input('provider_name') , 'access_token' => $request->input('access_token')])) {
            $provider = $request->input('provider_name');
            $token = $request->input('access_token');
            $providerUser = Socialite::driver($provider)->userFromToken($token);
            $user = User::where('provider_name', $provider)->where('provider_id', $providerUser->id)->first();
            if ($user == null) {
                $user = User::create([
                    'provider_name' => $provider,
                    'provider_id' => $providerUser->id,
                ]);
            }
            return response()->json([
                'token' => $user->createToken('appToken')->accessToken,
                'user' => new UserResource($user),
            ], 200);
        } else {
            // failure to authenticate
            return response()->json([
                'message' => 'Failed to authenticate.',
            ], 401);
        }
    }

    /**
     * logout an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function logout(Request $request)
    {
        if (Auth::user()) {
            $request->user()->token()->revoke();
            return response()->json([
                'message' => 'Logged out successfully',
            ], 200);
        }
    }

    /**
     * profile an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function profile(Request $request)
    {
        return new UserResource($request->user());
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        if ($request->profile_image) {
            $data['profile_image'] = $request->profile_image->store('profile-images');
        }
        $user = $request->user();
        $user->update($data);
        return new UserResource($user->fresh());
    }
}
