<?php
namespace App\Services;

use App\Models\Notification;
use App\Authentication\Session;
use App\Models\User;
use App\Models\Review;

class LikeActionsService extends DatabaseService
{

   function __construct()
   {
      parent::__construct();

   }

   private function addLike(int $user_id, int $review_id){
      
      $stmt = $this->connection->prepare("INSERT INTO like_actions (user_id, review_id) VALUES (?, ?)");
      $stmt->execute([$user_id, $review_id]);
   }

   private function deleteLikeById(int $id){
      $stmt = $this->connection->prepare("DELETE FROM like_actions WHERE id=?");
      $stmt->execute([$id]);
   }

   public function changeStatusOfLike(int $user_id, int $review_id){
      $stmt = $this->connection->prepare("SELECT * FROM like_actions WHERE user_id=? AND review_id=?");
      $stmt->execute([$user_id, $review_id]);
      if($stmt->rowCount() == 0) {
         $this->addLike($user_id, $review_id);
      }else{
         $like = $stmt->fetch();
         $this->deleteLikeById($like["id"]);
      }
   }

   public function isReviewLikedByLoggedUser(int $review_id){
      if(isset($_SESSION["user_id"])) $user_id=$_SESSION["user_id"];
      else return false;
      $stmt = $this->connection->prepare("SELECT * FROM like_actions WHERE user_id=? AND review_id=?");
      $stmt->execute([$user_id, $review_id]);
      if($stmt->rowCount() == 0) {
         return false;
      }else{
         return true;
      }
   }
}