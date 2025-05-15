<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    use ApiResponseTrait;
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return $this->errorResponse('Invalid email or password. Please try again', 401);
            }
            $token = $user->createToken('api-token')->plainTextToken;
            return $this->successResponse([
                'token' => $token,
                'user' => $user,
            ]);
        } catch (Exception $e) {
            Log::error('Unable to login: ' . $e->getMessage(), ['exception' => $e]);
            return $this->errorResponse('Unable to login.', 500, ['exception' => $e->getMessage()]);
        }
    }
}
