<?php 

namespace App\Controllers;


use App\Authentication\AuthenticationManager;
use App\Models\User;
use App\Services\ReviewService;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;

class ProfileController extends Controller
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
		$counter=0;
		$recensioni=[];

		if($this->authManager->login_check()){
            $profile = $this->userService->findUserById($_SESSION["user_id"]);
			$reviews = $this->reviewService->findByPublisher($profile);
			foreach($reviews as $review){
				$recensioni[$counter]=$this->reviewService->viewSerialize($review);
				$counter++;
			}
		}else{
			header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."login");
		}

        require_once APP_ROOT . '/views/home.php';
	}

  
}