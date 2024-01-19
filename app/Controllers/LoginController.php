<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;

class LoginController extends Controller
{
    private $userService;

    function __construct(){
        parent::__construct();
        $this->userService= new UserService();
    }
    
    public function index(RouteCollection $routes)
    {
        require_once APP_ROOT."/views/login.php";
    }

	public function login(RouteCollection $routes)
	{
        $username = $_POST["username"];
        $password = $_POST["password"];

        if($this->userService->login($username, $password)){
           header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."");
  
        }else{
           header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."login");

        }
	}

    public function logout(RouteCollection $route){
        if($this->authManager->login_check()){
            $this->authManager->logout();
            header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."");
   
        }else{
            header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."login");
 
        }
    }

  
}