<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserInterface;

class UserRepository implements UserInterface
{
    public $user;

    function __construct(User $user) {
	    $this->user = $user;
    }
    public function login($data)
    {
        return $this->user->login($data);
    }
    public function register($data)
    {
        return $this->user->register($data);
    }
    public function logout()
    {
        return $this->user->logout();
    }
}