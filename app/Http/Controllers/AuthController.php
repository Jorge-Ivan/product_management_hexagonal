<?php
namespace App\Http\Controllers;

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
        $data = $request->all();
        $result = $this->registerUser->execute($data);
        return response()->json($result, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $result = $this->loginUser->execute($credentials);
        return response()->json($result);
    }
}
