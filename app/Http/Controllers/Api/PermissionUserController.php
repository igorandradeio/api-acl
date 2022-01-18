<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{

    public function permissionUser($id)
    {
        $user = $this->user
            ->where('uuid', $id)
            ->with('permissions')
            ->firstOrFail();

        return PermissionResource::collection($user->permissions);
    }
}
