<?php 

namespace App\Controllers;


use App\Authentication\AuthenticationManager;
use App\Services\NotificationService;
use App\Services\ReviewService;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;

class HomeController extends Controller
{
	private $userService;
	private $reviewService;
	private $notificationService;


	function __construct(){
		parent::__construct();
		$this->userService= new UserService();
		$this->reviewService= new ReviewService();
		$this->notificationService=new NotificationService();
	}
    // Homepage action
	public function indexAction(RouteCollection $routes)
	{
		$recensioni=[];
		$counter=0;
		$has_notifications=false;

		if($this->authManager->login_check()){
			$follows= $this->userService->findFollowedByUserId($_SESSION["user_id"]);
			$notifications= $this->notificationService->findNotificationByUser($this->userService->findUserById($_SESSION["user_id"]));

			if(count($notifications)!=0){
				$has_notifications=true;
			}

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