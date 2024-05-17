<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Application\Validators\Auth\LoginFieldsValidator;

class LoginUser
{
    private $userRepository;
    private $loginFieldsValidator;

    public function __construct(UserRepositoryInterface $userRepository, LoginFieldsValidator $loginFieldsValidator)
    {
        $this->userRepository = $userRepository;
        $this->loginFieldsValidator = $loginFieldsValidator;
    }

    public function execute(array $credentials): array
    {
        $credentialsFields = $this->userValidator->validate($credentials);
        $user = $this->userRepository->findByEmail($credentialsFields['email']);

        if (!$user || !Hash::check($credentialsFields['password'], $user['password'])) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}

