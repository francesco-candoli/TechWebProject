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

   public function addLike(int $user_id, int $review_id)
   {
      
      $stmt = $this->connection->prepare("INSERT INTO like_actions (user_id, review_id) VALUES (?, ?)");
      $stmt->execute([$user_id, $review_id]);
   }

   public function deleteLikeById(int $id){
      $stmt = $this->connection->prepare("DELETE FROM like_actions WHERE id=?");
      $stmt->execute([$id]);
   }
}