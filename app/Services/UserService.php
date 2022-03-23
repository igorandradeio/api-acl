<?php

namespace App\Services;

use App\Repositories\{
    UserRepository
};

class UserService
{

    protected $repository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function getUsers()
    {
        return $this->UserRepository->getAllUsers();
    }

    public function createNewUser(array $data)
    {
        return $this->UserRepository->createNewUser($data);
    }

    public function getUserByUuid(string $uuid)
    {
        return $this->UserRepository->getUserByUuid($uuid);
    }

    public function updateUserByUuid(string $uuid, array $data)
    {
        return $this->UserRepository->updateUserByUuid($uuid, $data);
    }

    public function deleteUserByUuid(string $uuid)
    {
        return $this->UserRepository->deleteUserByUuid($uuid);
    }
}
