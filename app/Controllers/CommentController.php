<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Services\CommentService;
use App\Models\Comment;
use App\Services\ReviewService;
use Symfony\Component\Routing\RouteCollection;


class CommentController extends Controller
{
    private $commentService;
    private $reviewService;

    function __construct(){
        parent::__construct();
        $this->commentService=new CommentService();
        $this->reviewService=new ReviewService();
    }




    function add(RouteCollection $routes)
    {
        if ($this->authManager->login_check()) {
            if (!isset($_POST["content"])) {
                http_response_code(400);
                return "content cannot be null";
            }

            if (!isset($_POST["review_id"])) {
                http_response_code(400);
                return "review_id cannot be null";
            } else {
                if ($this->reviewService->findReviewById($_POST["review_id"]) == null) {
                    http_response_code(400);
                    return "there's no review with the following id: " . $_POST["review_id"];
                }

            }
            $this->commentService->save(new Comment(-1, $_POST["content"], $_POST["review_id"], $_SESSION["user_id"]));

            http_response_code(200);
            return "ok";
        }else{
            http_response_code(401);
            return "unathorized";
        }
    }

  
}