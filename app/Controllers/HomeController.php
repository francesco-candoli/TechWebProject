<?php 

namespace App\Controllers;


use App\Authentication\AuthenticationManager;
use App\Services\ReviewService;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;

class HomeController extends Controller
{
	private $userService;
	private $reviewService;


	function __construct(){
		parent::__construct();
		$this->userService= new UserService();
		$this->reviewService= new ReviewService();
	}
    // Homepage action
	public function indexAction(RouteCollection $routes)
	{
		$recensioni=[];
		$counter=0;

		if($this->authManager->login_check()){
			$follows= $this->userService->findFollowedByUserId($_SESSION["user_id"]);
			if($follows!=null){
				foreach($follows as $follow){
					$reviews = $this->reviewService->findByPublisher($follow);
					foreach($reviews as $review){
						$recensioni[$counter]=$this->reviewService->viewSerialize($review);
						$counter++;
					}
				}
			}else{
				$reviews = $this->reviewService->findLastRecent(2);
	
				foreach($reviews as $review){
					$recensioni[$counter]=$this->reviewService->viewSerialize($review);
					$counter++;
				}
			}
			
		}else{
			$reviews = $this->reviewService->findLastRecent(2);
	
				foreach($reviews as $review){
					$recensioni[$counter]=$this->reviewService->viewSerialize($review);
					$counter++;
				}
			
			
		}

        require_once APP_ROOT . '/views/home.php';
	}

  
}