<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    public function login(Request $request)
    {
        $data = (object) $request->all();
        $response = $this->user->login($data);

        return response()->json($response);
    }

    public function register(Request $request)
    {
        $data = (object) $request->all();
        $response = $this->user->register($data);
        return response()->json($response);
    }


    public function logout()
    {
        $response = $this->user->logout();
        return response()->json($response);
    }
}
