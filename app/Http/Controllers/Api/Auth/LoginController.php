<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\AuthUserService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserTokenResource;
use App\Http\Resources\ResponseErrorResource;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request, AuthUserService $authService)
    {
        $data = $request->validated();
        $user = $authService->checkCredentials($data);

        return $user
                ? UserTokenResource::make($user->createToken(Str::random(7)))
                : ResponseErrorResource::make([
                    'message' => 'Wrong credentials',
                    'errors' => [
                       'credentials' => __('passwords.wrong_credentials')
                    ]
                ])->response()->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
