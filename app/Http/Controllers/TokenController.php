<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (is_null($user) || !Hash::check($request->password,$user->password))
        {
            return response()->json(['Usuário ou senha inválidos'],401);
        }

        $token = JWT::encode(['email' => $request->email],
            env('JWT_KEY')
        );

        Log::channel('main')->info("Token gerado para o usuário $user");

        return [
            'access_token' => $token
        ];
    }
}
