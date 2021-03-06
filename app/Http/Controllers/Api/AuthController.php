<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required',
        ]);


        $user = User::where("name", $request->username)
            ->first();

        if (!is_null($user)) {
            if (!is_null($user->deleted_at)) {
                $user->deleted_at = null;
                $user->save();
            }
            return response()->json([
                'message' => 'Пользователь уже был создан ранее!'
            ], 201);
        }


        $user = new User([
            'name' => $request->username ?? '',
            'email' => $request->username . "@vk.com",
            'password' => bcrypt($request->username),
            'active' => false,
            'activation_token' => Str::random(60)
        ]);

        $user->save();

        return response()->json([
            'id'=>$user->id,
            'message' => 'Пользователь успешно создан! СМС с паролем доступа к ресурсу придет в течении нескольких минут!'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $name =$request->get("username");

        $credentials = request(['password']);
        $credentials['name'] = $name;
        $credentials['deleted_at'] = null;

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Ошибка авторизации! Неправильно введен телефон или код из СМС!'
            ]);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Пользователь успешно вышел!'
        ]);
    }
}
