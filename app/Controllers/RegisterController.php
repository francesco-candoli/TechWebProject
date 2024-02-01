<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Models\User;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;

class RegisterController extends Controller
{
    private $userService;

    function __construct(){
        parent::__construct();
        $this->userService= new UserService();
    }
    
    public function index(RouteCollection $routes)
    {
        require_once APP_ROOT."/views/registrazione.php";
    }

	public function register(RouteCollection $routes)
	{
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        $user= new User(-1, $_POST["username"], $_POST["password"], "", $_POST["age"], $_POST["sex"], $random_salt);
        $user->setPassword($_POST["password"]);
        $this->userService->save($user);
        if(isset($_SESSION["register_error"])){
            unset($_SESSION["register_error"]);
        }
        require_once APP_ROOT."/views/login.php";
	}


  
}