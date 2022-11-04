<?php 

namespace App\Repositories\User;


interface UserInterface {
    public function login($data);
    public function register($data);
    public function logout();
}