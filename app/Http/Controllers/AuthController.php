<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\RegisterRequest;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use function GuzzleHttp\Promise\all;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        if (!Auth::attempt($request->only('login', 'password')))
            return $this->handleError([
                'message' => 'Неправильный логин или пароль'], 401, 401);

        $user = User::where('login', $request['login'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->handleResponse(([
            'login' => $request['login'],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]), 'Авторизация успешна');

    }

    public function register(RegisterRequest $request)
    {
//        $validator = Validator::make($request->all(), [
//            'fullname' => 'required',
//            'organization_id' => 'required',
//            'login' => 'required|unique:users',
//            'password' => 'required',
//        ]);
//        if ($validator->fails()) {
//            return $this->handleError($validator->errors());
//        }
        if (User::where('login', $request->email)->exists()) {
            return AuthController::login($request);
        }
        $user = User::create([
            'fullname' => $request['fullname'],
            'login' => $request['login'],
            'password' => Hash::make($request['password']),
        ]);
        $user->save();
        $organizations_id = $request->organizations_id;
        $user->organizations()->attach($organizations_id);


        //$token = $user->createToken('auth_token')->plainTextToken;

        return $this->handleResponse(([
            'fullname' => $request['fullname'],
            'login' => $request['login'],
            'organizations' => $user->organizations
        ]),
            'Пользователь успешно добавлен');

    }
}
