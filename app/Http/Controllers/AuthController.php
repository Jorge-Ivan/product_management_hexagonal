<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Application\UseCases\Auth\RegisterUser;
use App\Application\UseCases\Auth\LoginUser;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $registerUser;
    private $loginUser;

    public function __construct(RegisterUser $registerUser, LoginUser $loginUser)
    {
        $this->registerUser = $registerUser;
        $this->loginUser = $loginUser;
    }

    public function register(Request $request)
    {
        $user = $this->registerUser->execute($userData);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $userData = $this->loginUser->execute($credentials);

        return response()->json($userData);
    }
}
