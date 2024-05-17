<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;

class EloquentCategoryRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
