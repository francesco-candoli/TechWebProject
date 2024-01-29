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

    public function index(string $user_id_review_id ,RouteCollection $routes){
        if($this->authManager->login_check()){
            $id=explode("_",$user_id_review_id);
            $this->likeActionsService->changeStatusOfLike(intval($id[0]),intval($id[1]));
        }
        
    }
}