<?php


namespace App\Services;

use App\Models\Notification;
use App\Authentication\Session;

class NotificationService extends DatabaseService
{

   function __construct()
   {
      parent::__construct();
   }

   public function findNOtificationById(int $id)
   {
      $stmt = $this->connection->prepare("SELECT * FROM notification WHERE id=?");
      $stmt->execute([$id]);
      $notification = $stmt->fetch();
      return new Notification($notification["id"], $notification["content"], $notification["url"]);
   }

   public function deleteNotificationById(int $id){
      $stmt = $this->connection->prepare("DELECT * FROM notification WHERE id=?");
      $stmt->execute([$id]);
      return $stmt->fetch();
   }
}