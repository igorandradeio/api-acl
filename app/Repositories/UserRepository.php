<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAllUsers()
    {
        return $this->entity->get();
    }

    public function createNewUser(array $data)
    {
        return $this->entity->create($data);
    }

    public function getUserByUuid(string $uuid)
    {
        return $this->entity
            ->with('permissions')
            ->where('uuid', $uuid)
            ->firstOrFail();
    }

    public function updateUserByUuid(string $uuid, array $data)
    {

        $user = $this->getUserByUuid($uuid);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $user->update($data);
    }

    public function deleteUserByUuid(string $uuid)
    {

        $user = $this->getUserByUuid($uuid);

        return $user->delete();
    }
}
