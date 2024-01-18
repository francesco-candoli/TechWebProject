<?php

namespace App\Controllers;
use App\Authentication\AuthenticationManager;

class Controller{
    protected $authManager;

    function __construct(){
        $this->authManager = new AuthenticationManager();
    }
}