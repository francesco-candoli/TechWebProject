<?php 

namespace App\Controllers;

use App\Models\User;
use App\Authentication\Validator;
use Symfony\Component\Routing\RouteCollection;

class LoginController
{
    // Homepage action
	public function createForm(RouteCollection $routes)
	{
        $this->validator=new Validator();
		if($this->validator->VerifyLogin()==false){
            require_once APP_ROOT . '/views/login.php';
            if(isset($_SESSION['loginErr'])){
                $_SESSION['loginErr']=NULL;
            }
		}else{
			http_response_code(200);
			header("Location: /corso/");exit();
		}
        
	}

    public function fetchData(RouteCollection $routes){
        $obj=NULL;
        $uname=$_POST["uname"];
        $pass=md5($_POST["passw"]);
        $user=new User();
        if($user->read($uname,$pass)==200){
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $obj->u_name=$user->getU_Name();
            $obj->mail=$user->getMail();
            $obj->nome=$user->getNome();
            $obj->cognome=$user->getCognome();
            $obj->ruolo=$user->getRuolo();
            $_SESSION['loginErr']=NULL;
            $jsonUser = json_encode($obj);
            $_SESSION['user']=$jsonUser;
            header("Location: /corso/");
        }else{
            $_SESSION['loginErr']="username o password errati";
            require_once APP_ROOT . '/views/login.php';
        }
        
        
    }

    public function register(int $id, int $id2){
        echo $id."   ".$id2;
        $errorStr="";
        {
            if(isset($_POST['uname'])){
                $uname=trim($_POST["uname"]);
            }else{
                $errorStr+="Username Vuoto ";
            }
            if(isset($_POST['passw'])){
                $passw=trim($_POST["passw"]);
            }else{
                $errorStr+="Password Vuota ";
            }
            if(isset($_POST['mail'])){
                $mail=trim($_POST['mail']);
                if( filter_var($email, FILTER_VALIDATE_EMAIL) === false ){
                    $errorStr+="Mail non valida "; 
                }
            }else{
                $errorStr+="Mail Vuota ";
            }
            if(isset($_POST['nome'])){
                $nome=trim($_POST['nome']);
            }else{
                $errorStr+="Nome Vuoto ";
            }
            if(isset($_POST['cognome'])){
                $cognome=trim($_POST['cognome']);
            }else{
                $errorStr+="Cognome Vuoto ";
            }
            if(isset($_POST['ruolo'])){
                $ruolo=trim($_POST['ruolo']);
            }else{
                $errorStr+="Ruolo Vuoto ";
            }          
        }
        
        if($errorStr==""){
            
        }

        
    }
    public function logout(){
        
    }
}