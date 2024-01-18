<?php 
namespace App\Models;
use PDO;


class Fornitore
{
	protected $codice;
	protected $descrizione;
	protected $note;
	protected $mail;

	public function getCodice()
	{
		return $this->codice;
	}

	public function getMail(){
		return $this->mail;
	}

	public function getDescrizione()
	{
		return $this->descrizione;
	}

    public function getNote()
	{
		return $this->note;
	}	

    public function insert(string $descrizione, string $note,string $mail){
        $status=true;
        $hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("INSERT INTO fornitore (descrizione,note,mail) VALUES(:descrizione,:note,:mail)");//two inputs and one output
        	$stmt->bindParam(":descrizione", $descrizione,PDO::PARAM_STR);
			$stmt->bindParam(":note", $note,PDO::PARAM_STR);
			$stmt->bindParam(":mail", $mail,PDO::PARAM_STR);
        	$stmt->execute();
			
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
    }

	public function delete(string $codice){
        $status=true;
        $hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("DELETE FROM Fornitore WHERE codice=:codice");//two inputs and one output
        	$stmt->bindParam(":codice", $codice,PDO::PARAM_STR);
        	$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
    }

    public function read_all(){
        $hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        
        $fornitori=array();
        $fornitore = [
            'codice'=>'',
            'descrizione'=>'',
            'note'=>'',
			'mail'=>''
        ];
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		$stmt = $db->prepare("SELECT * FROM fornitore");//two inputs and one output
        $stmt->execute();
        while($row = $stmt->fetch()){
			$fornitore['codice']=$row['codice'];
            $fornitore['descrizione']=$row['descrizione'];
            $fornitore['note']=$row['note'];
			$fornitore['mail']=$row['mail'];
            array_push($fornitori, $fornitore);
		}
		$db=NULL;
		return $fornitori;
    }
}
?>