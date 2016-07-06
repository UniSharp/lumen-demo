<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\ApiToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exceptions\AuthException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'logout']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;

        try {
            $user = User::whereUsername($username)->firstOrFail();

            if (! password_verify($password, $user->getAuthPassword())) {
                throw new Exception;
            }
        } catch (Exception $e) {
            throw new AuthException('使用者帳號或密碼錯誤');
        }

        $token = $user->tokens()->create([
            'token' => md5(microtime(true) . rand() . uniqid()),
            'expired_at' => Carbon::now()->addHour(),
        ]);

        return [
            'username' => $user->username,
            'name' => $user->name,
            'sex' => $user->sex,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'token' => $token->token,
        ];
    }

    public function logout(Request $request)
    {
        $token = $request->header('Api-Token');

        ApiToken::whereToken($token)->delete();

        return [
            'success' => true
        ];
    }
}
