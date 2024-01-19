<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;

class TestController extends Controller
{
    private $userService;

    function __construct(){
        parent::__construct();
        $this->userService= new UserService();
    }
    
    public function index(string $codice)
    {
        echo $codice;
    }


  
}