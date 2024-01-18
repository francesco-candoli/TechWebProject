<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;

class LoginController extends Controller
{
    private $userService;

    function __construct(){
        $this->userService= new UserService();
    }
    // Homepage action
	public function login(RouteCollection $routes)
	{
        $username = $_POST["username"];
        $password = $_POST["password"];

        if($this->userService->login($username, $password)){
            echo "logged in";
        }else{
            echo "not logged in";
        }
	}

  
}