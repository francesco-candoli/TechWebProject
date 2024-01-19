<?php 

namespace App\Controllers;


use App\Authentication\AuthenticationManager;
use Symfony\Component\Routing\RouteCollection;

class HomeController extends Controller
{
	function __construct(){
		parent::__construct();
	}
    // Homepage action
	public function indexAction(RouteCollection $routes)
	{
		
		if($this->authManager->login_check()){
			$data = ['message'=>"l'utente è loggato"];
		}else{
			$data = ['message'=>"l'utente non è loggato"];
		}
        require_once APP_ROOT . '/views/home.php';
        
	}

  
}