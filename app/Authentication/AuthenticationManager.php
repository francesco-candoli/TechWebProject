<?php

namespace App\Authentication;

use App\Services\DatabaseService;

class AuthenticationManager extends DatabaseService
{

   function __construct()
   {
      parent::__construct();
   }
   public function login_check()
   {
      // Verifica che tutte le variabili di sessione siano impostate correttamente
      if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
         $user_id = $_SESSION['user_id'];
         $login_string = $_SESSION['login_string'];
         $username = $_SESSION['username'];
         $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
         if ($stmt = $this->connection->prepare("SELECT password FROM user WHERE id = ? LIMIT 1")) {
            $stmt->execute([$user_id]); // Esegue la query creata.

            if ($stmt->rowCount() == 1) { // se l'utente esiste
               $result = $stmt->fetch();
               $password = $result["password"];
               $login_check = hash('sha512', $password . $user_browser);
               if ($login_check == $login_string) {
                  // Login eseguito!!!!
                  return true;
               } else {
                  //  Login non eseguito
                  return false;
               }
            } else {
               // Login non eseguito
               return false;
            }
         } else {
            // Login non eseguito
            return false;
         }
      } else {
         // Login non eseguito
         return false;
      }
   }

   public function logout()
   {
      $_SESSION = array();
      // Recupera i parametri di sessione.
      $params = session_get_cookie_params();
      // Cancella i cookie attuali.
      setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
      // Cancella la sessione.
      session_destroy();
   }


}