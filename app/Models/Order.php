<?php 
namespace App\Models;
use PDO;


class Order
{
	protected $codice;
	protected $giorno_pub;
    protected $mese_pub;
    protected $anno_pub;
    protected $giorno_ord;
    protected $mese_ord;
    protected $anno_ord;
    protected $u_name_pubblicato;
    protected $u_name_ordinato;
	protected $cod_fornitore;
    protected $chiuso;

	public function getCodice()
	{
		return $this->codice;
	}

	public function getDescrizione()
	{
		return $this->descrizione;
	}

    public function getNote()
	{
		return $this->note;
	}	

    public function insert_riga(string $codice_prodotto,string $codice_prodotto_int, string $descrizione, string $quantita, string $codice_ordine){
        $status=true;
        $hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("INSERT INTO riga (codice_prodotto,codice_prodotto_int,descrizione,quantita,codice_ordine) VALUES(:codice_prodotto,:codice_prodotto_int,:descrizione,:quantita,:codice_ordine)");//two inputs and one output
        	$stmt->bindParam(":codice_prodotto", $codice_prodotto,PDO::PARAM_STR);
			$stmt->bindParam(":codice_prodotto_int", $codice_prodotto_int,PDO::PARAM_STR);
        	$stmt->bindParam(":descrizione", $descrizione,PDO::PARAM_STR);
			$stmt->bindParam(":quantita", $quantita,PDO::PARAM_INT);
			$stmt->bindParam(":codice_ordine", $codice_ordine,PDO::PARAM_STR);
        	$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
    }

	public function delete_riga(int $codice){
        $status=true;
        $hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		try{
			$stmt = $db->prepare("DELETE FROM riga WHERE codice=:codice");//two inputs and one output
        	$stmt->bindParam(":codice", $codice,PDO::PARAM_INT);
        	$stmt->execute();
		}catch(Exception $e){
			$status=false;
		}
		$db=NULL;
		return $status;
    }


    public function read_open_order(string $codice){
        $hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        
        $result=404;
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		$stmt = $db->prepare("SELECT * FROM ordine WHERE cod_fornitore=:cod_fornitore AND chiuso=0");//two inputs and one output
		$stmt->bindParam(":cod_fornitore", $codice,PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetch()){
			$this->codice=$row['codice'];
            $this->giorno_pub=$row['giorno_pub'];
            $this->mese_pub=$row['mese_pub'];
            $this->anno_pub=$row['anno_pub'];
            $this->giorno_ord=$row['giorno_ord'];
            $this->mese_ord=$row['mese_ord'];
            $this->anno_ord=$row['anno_ord'];
            $this->u_name_pubblicato=$row['u_name_pubblicato'];
            $this->u_name_ordinato=$row['u_name_ordinato'];
            $this->cod_fornitore=$row['cod_fornitore'];
            $this->chiuso=$row['chiuso'];
            $result=200;
		}
		$db=NULL;
		return $result;
    }

	public function get_righe(string $codice){
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

		$righe=array();
		$riga=[
			'codice'=>'',
			'codice_prodotto'=>'',
			'codice_prodotto_int'=>'',
			'descrizione'=>'',
			'quantita'=>''
		];

		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		$stmt = $db->prepare("SELECT * FROM riga WHERE codice_ordine=:codice_ordine");//two inputs and one output
		$stmt->bindParam(":codice_ordine", $codice,PDO::PARAM_STR);
        $stmt->execute();

		while($row = $stmt->fetch()){
			$riga['codice']=$row['codice'];
			$riga['codice_prodotto']=$row['codice_prodotto'];
			$riga['codice_prodotto_int']=$row['codice_prodotto_int'];
			$riga['descrizione']=$row['descrizione'];
			$riga['quantita']=$row['quantita'];
			array_push($righe,$riga);
		}
		$db=NULL;
		return $righe;
	}

	public function get_order(string $codice){
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		$stmt = $db->prepare("SELECT COUNT(*) AS n_orders FROM ordine WHERE codice=:codice_ordine");//two inputs and one output
		$stmt->bindParam(":codice_ordine", $codice,PDO::PARAM_STR);
        $stmt->execute();

		$row = $stmt->fetch();

		$db=NULL;
		return $row[0];
	}

	public function create_order(string $codice,int $giorno_pub, int $mese_pub, int $anno_pub, string $u_name_pubblicato, int $cod_fornitore ){
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

		$response=[
			'message'=>'',
			'result'=>false
		];

		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		$stmt = $db->prepare("SELECT COUNT(*) AS open_orders FROM ordine WHERE cod_fornitore=:cod_fornitore AND chiuso=0");//two inputs and one output
		$stmt->bindParam(":cod_fornitore", $cod_fornitore,PDO::PARAM_STR);
        $stmt->execute();
		$row = $stmt->fetch();

		if($row[0]==0){
			try{
				$stmt = $db->prepare("INSERT INTO ordine VALUES(:codice,:giorno_pub,:mese_pub,:anno_pub,0,0,0,:u_name_pubblicato,NULL,:cod_fornitore,0)");//two inputs and one output
				$stmt->bindParam(":codice", $codice,PDO::PARAM_STR);
				$stmt->bindParam(":giorno_pub", $giorno_pub,PDO::PARAM_INT);
				$stmt->bindParam(":mese_pub", $mese_pub,PDO::PARAM_INT);
				$stmt->bindParam(":anno_pub", $anno_pub,PDO::PARAM_INT);
				$stmt->bindParam(":u_name_pubblicato", $u_name_pubblicato,PDO::PARAM_STR);
				$stmt->bindParam(":cod_fornitore", $cod_fornitore,PDO::PARAM_INT);
        		$stmt->execute();

				$response['message']='Ok';
				$response['result']=true;

			}catch(Exception $e){
				$response['message']=$e;
				$response['result']=false;
			}
			
		}else{
			$response['message']='Ce gia un ordine aperto per questo fornitore, completalo!';
			$response['result']=false;
		}

		$db=NULL;
		return json_encode($response);
	}

	public function get_closed_orders($cod_fornitore){
		$hostname = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

		$codici_ordini=array();
		

		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
		$stmt = $db->prepare("SELECT codice FROM ordine WHERE chiuso=1 AND cod_fornitore=:cod_fornitore");//two inputs and one output
		$stmt->bindParam(":cod_fornitore", $cod_fornitore,PDO::PARAM_INT);
        $stmt->execute();
		while($row = $stmt->fetch()){
			array_push($codici_ordini,$row['codice']);
		}

		return $codici_ordini;
	}

	public function get_closing_date($cod_ordine){
		//DA RESDTITUIRE LA DATA DI CHIUSURA DEGLI ORDINI, CHE UTILIZZEREMO DA AGIUNGERE NELL CONTROLLER PER RESTIRUIRE GLI ORDINI CHIUSI
	}
}
?>