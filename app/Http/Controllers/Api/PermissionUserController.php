<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPermissionUser;
use App\Http\Resources\PermissionResource;
use App\Services\UserService;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function permissionUser($uuid)
    {
        $user = $this->userService->getUserByUuid($uuid);

        return PermissionResource::collection($user->permissions);
    }

    public function addPermissionsUser(AddPermissionUser $request)
    {
        $user = $this->userService->getUserByUuid($request->user);

        $user->permissions()->attach($request->permissions);

        return response()->json(['message' => 'success']);
    }
}
