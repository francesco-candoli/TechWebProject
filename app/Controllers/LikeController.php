<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Services\LikeActionsService;
use Symfony\Component\Routing\RouteCollection;


class LikeController extends Controller
{
    private $likeActionsService;

    function __construct(){
        parent::__construct();

        $this->likeActionsService= new LikeActionsService();
    }

    public function add(string $user_id_review_id ,RouteCollection $routes){
        $id=explode("_",$user_id_review_id);
        $this->likeActionsService->addLike(intval($id[0]),intval($id[1]));
    }


    public function delete(int $like_id, RouteCollection $routes){
            $this->likeActionsService->deleteLikeById($like_id);      
    }


  
}