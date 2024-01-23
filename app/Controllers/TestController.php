<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;
use App\Models\Restaurant;
use App\Services\RestaurantService;

class TestController extends Controller
{
    private $userService;

    function __construct(){
        parent::__construct();
        $this->userService= new UserService();
    }

    public function index(RouteCollection $routes)
    {


        $service = new RestaurantService();

        $restaurant = $service->findRestaurantById(1);

        $restaurant->setName("TEST UPATE");

        $service->save($restaurant);

    }


  
}