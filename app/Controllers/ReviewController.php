<?php

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Models\Restaurant;
use App\Models\Review;
use App\Services\CommentService;
use App\Models\Comment;
use App\Services\RestaurantService;
use App\Services\ReviewService;
use Symfony\Component\Routing\RouteCollection;


class ReviewController extends Controller
{
    private $reviewService;
    private $restaurantService;

    function __construct()
    {
        parent::__construct();
        $this->reviewService = new ReviewService();
        $this->restaurantService = new RestaurantService();
    }




    public function add(RouteCollection $routes)
    {

        if (!isset($_POST["restaurant_name"])) {
            http_response_code(400);
            return "restaurant_name cannot be null";
        }

        if (!isset($_POST["restaurant_address"])) {
            http_response_code(400);
            return "restaurant_address cannot be null";
        }

        if (!isset($_POST["content"])) {
            http_response_code(400);
            return "content cannot be null";
        }

        if (!isset($_POST["vote"])) {
            http_response_code(400);
            return "vote cannot be null";
        }

        if ($this->authManager->login_check()) {
            $res = $this->restaurantService->findRestaurantByName($_POST["restaurant_name"]);
            if ($res == null) {
                $this->restaurantService->save(new Restaurant(-1, $_POST["restaurant_name"], $_POST["restaurant_address"]));
            } else {
                $this->restaurantService->save($res);
            }

            $this->reviewService->save(new Review(-1, $_POST["content"], $_POST["vote"], $this->restaurantService->findRestaurantByName($_POST["restaurant_name"])->getId(), $_SESSION["user_id"]));

            http_response_code(200);
            return "ok";
        } else {
            header("Location: " . PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . "login");
        }


    }


}


