<?php


namespace App\Services;

use App\Models\Notification;
use App\Authentication\Session;
use App\Models\User;

class NotificationService extends DatabaseService
{

   function __construct()
   {
      parent::__construct();

   }

   public function findNotificationById(int $id)
   {
      $stmt = $this->connection->prepare("SELECT * FROM notification WHERE id=?");
      $stmt->execute([$id]);
      $notification = $stmt->fetch();
      return new Notification($notification["id"], $notification["content"], $notification["url"]);
   }

   public function findNotificationByUser(User $user)
   {
      $stmt = $this->connection->prepare("SELECT * FROM has_notification WHERE user_id=?");
      $stmt->execute([$user->getID()]);
      $i = 0;
      $notifications = [];
      while ($row = $stmt->fetch()) {
         $notifications[$i]= $this->findNotificationById($row["notification_id"]);
         $i++;
      }
      return $notifications;

   }

   public function deleteNotificationById(int $id){
      $stmt = $this->connection->prepare("DELETE FROM has_notification WHERE notification_id=?");
      $stmt->execute([$id]);
      $stmt = $this->connection->prepare("DELETE FROM notification WHERE id=?");
      $stmt->execute([$id]);
   }

   
}