<?php
namespace App\Application\UseCases\Auth;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\Validators\User\UserCreateValidator;

class RegisterUser
{
    private $userRepository;
    private $userValidator;

    public function __construct(UserRepositoryInterface $userRepository, UserCreateValidator $userValidator)
    {
        $this->userRepository = $userRepository;
        $this->userValidator = $userValidator;
    }

    public function execute(array $data): User
    {
        $userData = $this->userValidator->validate($data);
        return $this->userRepository->create($userData);
    }
}
