<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAPIController extends Controller
{
    /**
     * POST api/login
     *
     * @param Request $request
     * @return JsonResponse|Response
     * @throws \Exception
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')])) {
            return app()->handle(Request::create('/oauth/token', 'POST', $request->all()));
        }

        return $this->unauthorizedError();
    }
}
