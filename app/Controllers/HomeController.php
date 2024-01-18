<?php 

namespace App\Controllers;

use App\Models\User;
use App\Authentication\Validator;
use Symfony\Component\Routing\RouteCollection;

class HomeController
{
    // Homepage action
	public function indexAction(RouteCollection $routes)
	{

        require_once APP_ROOT . '/views/home.php';
        
	}

  
}