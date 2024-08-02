<?php

namespace App\Http\Controllers;

use App\Models\User;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiResponseHelpers;

    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

       $validatedData = array(
           'name' => $data['name'],
           'email' => $data['email'],
           'password' => bcrypt($data['password']),
       );

        $user = User::firstOrCreate($validatedData);

        return $this->respondCreated([
            'user' => $user,
            'token' => $user->createToken('api-token of ' . $user->name)->plainTextToken
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($data)) {
            return response()->json('credentials does not match');
        }

        session()->regenerate();
        $user = User::where('email', $data['email'])->firstOrFail();

        return $this->respondWithSuccess([
            'user' => $user,
            'token' => $user->createToken('api-token of ' . $user->name)->plainTextToken
        ]);

    }
}
