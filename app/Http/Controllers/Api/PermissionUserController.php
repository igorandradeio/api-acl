<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPermissionUser;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Services\UserService;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::denies('add_permissions_user')) {
            abort(403, 'Not Authorized');
        }

        $user = $this->userService->getUserByUuid($request->user);

        $user->permissions()->attach($request->permissions);

        return response()->json(['message' => 'success']);
    }

    public function userHasPermissionsUser(Request $request, $permission)
    {
        $user =  $request->user();

        if (!$user->isSuperAdmin() && !$user->hasPermission($permission)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['message' => 'success']);
    }
}
