<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Models\Photo;
use App\Services\PhotoService;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;
use App\Models\Restaurant;

class TestController extends Controller
{
    private $userService;

    function __construct(){
        parent::__construct();
        $this->userService= new UserService();
    }

    public function index(RouteCollection $routes)
    {
        
    }


  
}