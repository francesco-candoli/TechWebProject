<?php 

namespace App\Controllers;


use App\Authentication\AuthenticationManager;
use App\Models\User;
use App\Services\ReviewService;
use App\Services\UserService;
use App\Services\NotificationService;
use Symfony\Component\Routing\RouteCollection;

class ProfileController extends Controller
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
	public function indexAction(string $username, RouteCollection $routes)
	{
		$counter=0;
		$recensioni=[];
		$canFollow=false;
		$has_notifications=false;

		if($this->authManager->login_check()){
			$notifications= $this->notificationService->findNotificationByUser($this->userService->findUserById($_SESSION["user_id"]));

			if(count($notifications)!=0){
				$has_notifications=true;
			}

			if($this->userService->findUserByUsername($username)==null){
				$error_message = "Username non trovato";
			}else{
				if($username==$_SESSION["username"]){
					$canFollow=false;
					$canPost=true;
				}else{
					$canFollow=true;
					$follow = $this->userService->ifFollowWithUsername($_SESSION["username"], $username);
					$canPost=false;
				}
				$profile = $this->userService->findUserByUsername($username);
				$reviews = $this->reviewService->findByPublisher($profile);
				if($reviews != null){
					foreach($reviews as $review){
						$recensioni[$counter]=$this->reviewService->viewSerialize($review);
						$counter++;
					}
				}
			}
		}else{
			header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."login");
		}

        require_once APP_ROOT . '/views/home.php';
	}

	public function changeFollowStatus(int $user_id, RouteCollection $routes){
		if($this->authManager->login_check()){
            $this->userService->changeFollowStatus($user_id);
        }
	}

	public function changeProfileImage(RouteCollection $routes){
		$photoFullPath = $this->uploadImage($_SERVER['DOCUMENT_ROOT']."/".URL_SUBFOLDER.PROFILE_IMAGE_PATH,$_FILES['profileImage']["name"],$_FILES['profileImage']["tmp_name"]);
		if($photoFullPath!="err"){
			$photoExp=explode("/",$photoFullPath);
			$photoName=end($photoExp);
			$newPhotoSrc=PROFILE_IMAGE_PATH.$photoName;

			$oldPhotoSrc=$this->userService->updateProfilePhoto($_SESSION["user_id"],$newPhotoSrc);
			
			if($oldPhotoSrc!=PROFILE_IMAGE_PATH.DEFAULT_PROFILE_IMAGE){
				unlink($_SERVER['DOCUMENT_ROOT']."/".URL_SUBFOLDER.$oldPhotoSrc);
			}
		}
		

		header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."profile/".$_SESSION["username"]);
	}

	public function deleteProfileImage(RouteCollection $routes){
		$oldPhotoSrc=$this->userService->updateProfilePhoto($_SESSION["user_id"],PROFILE_IMAGE_PATH.DEFAULT_PROFILE_IMAGE);
		unlink($_SERVER['DOCUMENT_ROOT']."/".URL_SUBFOLDER.$oldPhotoSrc);
		header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."profile/".$_SESSION["username"]);
	}

	private function uploadImage($path, $name, $tmp_name){
        $allowedType = array('jpg', 'jpeg', 'png');        // allowed extensions
        $err = '';
        
        $imageName = basename($name);
        $fullPath = $path.$imageName;

        $sepext = explode('.', strtolower($name));
        $type = end($sepext);

        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($name), PATHINFO_FILENAME)."_$i.".$type;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
        }

        if(!in_array($type, $allowedType)) $err .= "Il file non possiede un estensione consentita";
        //if($image["size"] > 5000 * 1024) $err .= "Il file è troppo pesante";

        //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
        if(strlen($err)==0){
            if(!move_uploaded_file($tmp_name, $fullPath)){
                $err.= "Errore nel caricamento dell'immagine.";
            }
        }
        if(strlen($err)==0){
            return ($fullPath);
        }else{
            return "err";
        }
        
    }

	

  
}