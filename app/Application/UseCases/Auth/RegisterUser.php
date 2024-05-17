<?php
namespace App\Application\UseCases\Auth;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\Validators\User\UserCreateValidator;

class RegisterUser
{
    private $userRepository;
    private $userValidator;

    public function __construct(UserRepositoryInterface $userRepository, UserValidator $userValidator)
    {
        $this->userRepository = $userRepository;
        $this->userValidator = $userValidator;
    }

    public function execute(array $data): array
    {
        $userData = $this->userValidator->validate($data);
        return $this->userRepository->create($userData);
    }
}
