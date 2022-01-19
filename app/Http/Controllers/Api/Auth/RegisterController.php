<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUser;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(StoreUser $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        $user = $this->userService->createNewUser($data);

        return (new UserResource($user))
            ->additional([
                'token' => $user->createToken($request->device_name)->plainTextToken,
            ]);
    }
}
