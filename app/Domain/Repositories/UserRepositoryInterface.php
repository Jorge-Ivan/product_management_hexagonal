<?php
namespace App\Domain\Repositories;

interface UserRepositoryInterface
{
    public function create(array $data): array;
    public function findByEmail(string $email): ?array;
}
