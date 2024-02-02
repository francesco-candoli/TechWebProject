<?php 

namespace App\Controllers;

use App\Authentication\AuthenticationManager;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Photo;
use App\Services\PhotoService;
use App\Services\ReviewService;
use App\Services\RestaurantService;
use Symfony\Component\Routing\RouteCollection;

class UploadController extends Controller
{
	private $restaurantService;
	private $reviewService;
    private $photoService;


	function __construct(){
		parent::__construct();
		$this->restaurantService= new RestaurantService();
		$this->reviewService= new ReviewService();
        $this->photoService= new PhotoService();
	}
    // Homepage action
	public function index(RouteCollection $routes){
		if($this->authManager->login_check()){
			require_once APP_ROOT . '/views/upload.php';
		}else{
			header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."login");
		}
	}


    public function uploadResources(RouteCollection $routes){
        
        //controllo nome ristorante inserito
        $restaurant=$this->restaurantService->findRestaurantByName($_POST["ristorante"]);
        if($restaurant==null){
            if(!isset($_POST["indirizzo"])){
                $_SESSION["upload_error"]="non è stato pseicifcato l'indirizzo del ristorante!";
                header("Location: ".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."upload/");
            }
            $new_restaurant_id=$this->restaurantService->save(new Restaurant(-1,$_POST["ristorante"], "address"));
            $restaurant=$this->restaurantService->findRestaurantById($new_restaurant_id);
        }


        $photos=[];
        if(isset($_FILES['fileup'])) {
            for($i=0;$i<count($_FILES['fileup']['name']);$i++){
                if($_FILES['fileup']['name'][$i]!=""){
                    $photoFullPath=$this->uploadImage($_SERVER['DOCUMENT_ROOT']."/".URL_SUBFOLDER.REVIEW_IMAGE_PATH,$_FILES['fileup']["name"][$i],$_FILES['fileup']["tmp_name"][$i]);
                    if($photoFullPath!="err"){
                        $photoExp=explode("/",$photoFullPath);
                        $photoName=end($photoExp);
                        $photoSrc=REVIEW_IMAGE_PATH.$photoName;
                        array_push($photos,$photoSrc);
                    }
                    
                }
            }
        }
        if(count($photos)!=0){
            $lastId=$this->reviewService->save(new Review(-1, $_POST["content"], $_POST["vote"], $restaurant->getId(), $_SESSION["user_id"], "date"));
            foreach($photos as $src){
                $this->photoService->save(new Photo(-1, $src, "standard-alt",$lastId));
            }
        }
        

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