<?php


namespace App\Services;

use App\Models\User;
use App\Models\HasNotification;
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
      return new User($user["id"], $user["username"], $user["password"], $user["age"], $user["sex"], $user["salt"]);
   }

   private function update(){

   }

   public function save(User $user)
   {
      $userFromDb= $this->findUserById($user->getID());
      
      $stmt = $this->connection->prepare("UPDATE user SET username= ? password ")->execute([]);
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

}