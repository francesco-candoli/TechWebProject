<?php
namespace App\Services;

use App\Models\User;
use App\Models\HasNotification;
use App\Models\Follow;
use App\Authentication\Session;

class UserService extends DatabaseService
{

   function __construct()
   {
      parent::__construct();

   }
   public function findUserById(int $id)
   {

      // select a particular user by id
      $stmt = $this->connection->prepare("SELECT * FROM user WHERE id=?");
      $stmt->execute([$id]);
      $user = $stmt->fetch();

      if($stmt->rowCount()==0){
         return null;
      }

      return new User($user["id"], $user["username"], $user["password"], $user["profile_image_src"], $user["age"], $user["sex"], $user["salt"]);
   }

   public function findUserByUsername(string $username)
   {

      // select a particular user by id
      $stmt = $this->connection->prepare("SELECT * FROM user WHERE username=?");
      $stmt->execute([$username]);
      $user = $stmt->fetch();

      if($stmt->rowCount()==0){
         return null;
      }

      return new User($user["id"], $user["username"], $user["password"], $user["profile_image_src"], $user["age"], $user["sex"], $user["salt"]);
   }

   public function save(User $user)
   {
      
      $stmt = $this->connection->prepare("INSERT INTO user (username,password,age,sex,salt) VALUES (?,?,?,?,?)")->execute([$user->getUsername(), $user->getPassword(), $user->getAge(), $user->getSex(), $user->getSalt()]);
   }

   public function updateProfilePhoto(int $user_id, string $newSrc){
      $oldPhotoSrc = $this->findUserById($user_id)->getProfileImageSrc();
      $stmt = $this->connection->prepare("UPDATE user SET profile_image_src = ? WHERE id = ?;")->execute([$newSrc, $user_id]);

      //restituisce Src della foto rimossa
      return $oldPhotoSrc;
   }

   public function login($username, $password)
   {
      // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
      if ($stmt = $this->connection->prepare("SELECT id, username, password, age, sex, salt FROM user WHERE username = ? LIMIT 1")) {
         $stmt->execute([$username]); // esegue la query appena creata.
         $user = $stmt->fetch();

         $password = hash('sha512', $password . $user["salt"]); // codifica la password usando una chiave univoca.

         if ($stmt->rowCount() == 1) { // se l'utente esiste
            // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
            if ($this->checkbrute($user["id"]) == true) {
               // Account disabilitato
               // Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.

               return false;

            } else {
               if ($user["password"] == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                  // Password corretta!            
                  $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                  $user_id = preg_replace("/[^0-9]+/", "", $user["id"]); // ci proteggiamo da un attacco XSS
                  $_SESSION['user_id'] = $user_id;
                  $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                  $_SESSION['username'] = $username;
                  $_SESSION['login_string'] = hash('sha512', $password . $user_browser);

                  // Login eseguito con successo.
                  return true;
               } else {

                  // Password incorretta.
                  // Registriamo il tentativo fallito nel database.
                  $now = time();
                  $this->connection->query("INSERT INTO login_attempts (user_id, time) VALUES (" . $user["id"] . ", '$now')");

                  return false;
               }
            }
         } else {

            // L'utente inserito non esiste.
            return false;
         }
      }
   }

   public function checkbrute($user_id)
   {
      // Recupero il timestamp
      $now = time();
      // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
      $valid_attempts = $now - (2 * 60 * 60);
      if ($stmt = $this->connection->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
         // Eseguo la query creata.
         $stmt->execute([$user_id]);

         // Verifico l'esistenza di più di 5 tentativi di login falliti.
         if ($stmt->rowCount() > 5) {

            return true;
         } else {

            return false;
         }
      }
   }

   public function findHasNotificationByUserId(int $id)
   {
      $stmt = $this->connection->prepare("SELECT * FROM has_notification WHERE user_id=?");
      $stmt->execute([$id]);
      $hasNot = $stmt->fetch();

      if($stmt->rowCount()==0){

         return null;
      }
      
      for($i=0; $i<count($hasNot); $i++)
      { 
        $hasNotification[$i] = new HasNotification($hasNot[$i]["id"], $hasNot[$i]["user_id"], $hasNot[$i]["notification_id"]);
      }

      return $hasNotification;
   }

   public function findFollowedByUserId($following_user_id){
      $stmt = $this->connection->prepare("SELECT * FROM follow WHERE following_user_id=?");
      $stmt->execute([$following_user_id]);

      

      if($stmt->rowCount()==0){

         return null;
      }

      $i=0;
      $followed=[];
      while($follow = $stmt->fetch())
      { 
        $followed[$i] = $this->findUserById($follow["followed_user_id"]);
        $i++;
      }
  
      return $followed;
   }

   public function ifFollowWithUsername($following_username, $followed_username){
      $following_user = $this->findUserByUsername($following_username);
      $followed_user = $this->findUserByUsername($followed_username);

      if($following_user==null || $followed_user== null){
         return false;
      }

      $stmt = $this->connection->prepare("SELECT * FROM follow WHERE following_user_id=? AND followed_user_id=?");
      $stmt->execute([$following_user->getID(), $followed_user->getID()]);

      if($stmt->rowCount()==0){
         return false;
      }

      return true;

   }

   public function changeFollowStatus(int $user_id){
      $stmt = $this->connection->prepare("SELECT * FROM follow WHERE following_user_id=? AND followed_user_id=?");
      $stmt->execute([$_SESSION["user_id"], $user_id]);
      if($stmt->rowCount() == 0) {
         $this->addFollow($_SESSION["user_id"], $user_id);
      }else{
         $this->deleteFollow($_SESSION["user_id"], $user_id);
      }
   }

   private function addFollow(int $following_user_id,int $followed_user_id){
      $stmt = $this->connection->prepare("INSERT INTO follow (following_user_id,followed_user_id) VALUES (?, ?)");
      $stmt->execute([$following_user_id, $followed_user_id]);
	}

	private function deleteFollow(int $following_user_id,int $followed_user_id){
      $stmt = $this->connection->prepare("DELETE FROM follow WHERE following_user_id=? AND followed_user_id=?");
      $stmt->execute([$following_user_id, $followed_user_id]);	
	}

   public function countFollowersById(int $user_id){
      $stmt = $this->connection->prepare("SELECT * FROM follow WHERE followed_user_id=?");
      $stmt->execute([$user_id]);
      return $stmt->rowCount();
   }

   public function countFollowingById(int $user_id){
      $stmt = $this->connection->prepare("SELECT * FROM follow WHERE following_user_id=?");
      $stmt->execute([$user_id]);
      return $stmt->rowCount();
   }

}