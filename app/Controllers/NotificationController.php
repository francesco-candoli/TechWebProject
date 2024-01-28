<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Models\Notification;
use App\Services\NotificationService;
use App\Services\UserService;
use Symfony\Component\Routing\RouteCollection;


class NotificationController extends Controller
{
    private $userService;
    private $notificationService;

    function __construct(){
        parent::__construct();
        $this->userService= new UserService();
        $this->notificationService = new NotificationService();
    }

    public function index(RouteCollection $routes)
    {
        if($this->authManager->login_check()){
            $notifiche = $this->notificationService->findNotificationByUser($this->userService->findUserById($_SESSION["user_id"]));
            require_once APP_ROOT."/views/notifiche.php";
        }else{
            header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."login");
        }

        
    }


    public function delete(int $notification_id, RouteCollection $routes){
        if($this->authManager->login_check()){
            $this->notificationService->deleteNotificationById($notification_id);
            return "ok";
        }else{
            header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."login");
        }

       
    }


  
}