<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Models\HotelUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends BaseController
{
    public function store(LoginRequest $request)
    {
        $validated = $request->safe()->all();

        $user = HotelUser::where('email', $validated['email'])->first();
        if (Hash::check($validated['password'], $user->password)) {
            $device_name = $request->userAgent();
            $response['token'] = $user->createToken($device_name)->plainTextToken;
            return $this->sendResponse($response);
        }
        return $this->sendResponse('Invalid credentials', 401, 'Fail');
    }

    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();
        if (null === $token) {
            $user->currentAccessToken()->delete();
            return $this->sendResponse('Logout');
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);
        if ($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable_type) {
            $personalAccessToken->delete();
            return $this->sendResponse('Logout');
        }
        
        return $this->sendResponse('Bad request', 422, 'Fail');
    }
}
