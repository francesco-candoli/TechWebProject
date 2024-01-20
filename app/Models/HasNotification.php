<?php

namespace App\Models;

class HasNotification{
    private int $id;
    private int $user_id;
    private int $notification_id;

    function __construct(int $id, int $user_id, int $notification_id){
        $this->id=$id;
        $this->user_id=$user_id;
        $this->notification_id=$notification_id;
    }

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId(int $user_id){
        $this->user_id= $user_id;
    }
    
    public function getNotificationId(){
        return $this->notification_id;
    }

    public function setNotificationId(int $notification_id){
        $this->notification_id= $notification_id;
    }
}
