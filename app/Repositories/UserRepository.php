<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAllUsers()
    {

        return Cache::rememberForever('users', function () {
            return $this->entity->with('permissions')->get();
        });
    }

    public function createNewUser(array $data)
    {
        Cache::forget('users');

        return $this->entity->create($data);
    }

    public function getUserByUuid(string $uuid)
    {

        return $this->entity
            ->where('uuid', $uuid)
            ->with('permissions')
            ->firstOrFail();
    }

    public function updateUserByUuid(string $uuid, array $data)
    {

        $user = $this->getUserByUuid($uuid);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        Cache::forget('users');

        return $user->update($data);
    }

    public function deleteUserByUuid(string $uuid)
    {

        $user = $this->getUserByUuid($uuid);

        Cache::forget('users');

        return $user->delete();
    }
}
