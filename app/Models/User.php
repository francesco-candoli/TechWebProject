<?php 
namespace App\Models;
use PDO;


class User
{
	protected $u_name;
	protected $passw;
	protected $mail;
	protected $nome;
	protected $cognome;
	protected $ruolo;

	public function getU_Name()
	{
		return $this->u_name;
	}

	public function getMail()
	{
		return $this->mail;
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function getCognome()
	{
		return $this->cognome;
	}

	public function getRuolo()
	{
		return $this->ruolo;
	}

	public function updateUsername(string $username, string $username1){
		$status=true;
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		$stmt = $db->prepare("SELECT COUNT(*) AS 'count' FROM utente WHERE u_name=:uname");
		$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch();
		if($row['count']==0){
			try{
				$stmt = $db->prepare("UPDATE utente SET u_name=:uname WHERE u_name=:uname1");//two inputs and one output
				$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
				$stmt->bindParam(":uname1", $username1,PDO::PARAM_STR);
				$stmt->execute();
			}catch(Exception $e){
				$status=false;
			}
		}else{
			$status=false;
		}
		$db=NULL;
		return $status;
	}

	public function updatePassword(string $password,string $username){
		$status=true;
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("UPDATE utente SET passw=:passw WHERE u_name=:uname");//two inputs and one output
			$stmt->bindParam(":passw", $password,PDO::PARAM_STR);
			$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
			$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
	}

	public function updateMail(string $mail, string $username){
		$status=true;
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("UPDATE utente SET mail=:mail WHERE u_name=:uname");//two inputs and one output
			$stmt->bindParam(":mail", $mail,PDO::PARAM_STR);
			$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
			$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
	}

	public function updateNome(string $nome, string $username){
		$status=true;
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("UPDATE utente SET nome=:nome WHERE u_name=:uname");//two inputs and one output
			$stmt->bindParam(":nome", $nome,PDO::PARAM_STR);
			$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
			$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
	}

	public function updateCognome(string $cognome, string $username){
		$status=true;
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("UPDATE utente SET cognome=:cognome WHERE u_name=:uname");//two inputs and one output
			$stmt->bindParam(":cognome", $cognome,PDO::PARAM_STR);
			$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
			$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
	}
	
	public function updateRuolo(string $ruolo, string $username){
		$status=true;
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("UPDATE utente SET ruolo=:ruolo WHERE u_name=:uname");//two inputs and one output
			$stmt->bindParam(":ruolo", $ruolo,PDO::PARAM_STR);
			$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
			$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
	}

	public function delete(string $username){
		$status=true;
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("UPDATE utente SET active=0 WHERE u_name=:uname");//two inputs and one output
			$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
			$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
	}

	public function read(string $uname, string $passw){
		$result=401;
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        $db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		$stmt = $db->prepare("SELECT * FROM utente WHERE u_name=:uname AND passw=:passw");//two inputs and one output
        $stmt->bindParam(":uname", $uname,PDO::PARAM_STR);
        $stmt->bindParam(":passw", $passw,PDO::PARAM_STR);
        $stmt->execute();

        while($row = $stmt->fetch()){
			if($row['active']==1){
				$this->u_name=$row['u_name'];
				$this->mail=$row['mail'];
				$this->passw=$row['passw'];
				$this->nome=$row['nome'];
				$this->cognome=$row['cognome'];
				$this->ruolo=$row['ruolo'];
				$result=200;
			}
		}
       
		$db=null;
        return $result;
	}

	public function insert(string $username, string $password, string $mail, string $nome, string $cognome, string $ruolo){
		$status=true;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("INSERT INTO utente VALUES(:uname,:passw,:mail,:nome,:cognome,:ruolo,1)");//two inputs and one output
        	$stmt->bindParam(":uname", $username,PDO::PARAM_STR);
        	$stmt->bindParam(":passw", $password,PDO::PARAM_STR);
			$stmt->bindParam(":mail", $mail,PDO::PARAM_STR);
        	$stmt->bindParam(":nome", $nome,PDO::PARAM_STR);
			$stmt->bindParam(":cognome", $cognome,PDO::PARAM_STR);
        	$stmt->bindParam(":ruolo", $ruolo,PDO::PARAM_STR);
        	$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
	}


	
}
?>