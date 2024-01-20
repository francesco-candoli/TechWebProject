<?php

namespace App\Models;

class LikeAttempts{
    private int $user_id;
    private string $time;

    function __construct(int $user_id, string $time){
        $this->user_id=$user_id;
        $this->time=$time;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId(int $user_id){
        $this->user_id= $user_id;
    }
    
    public function getTime(){
        return $this->time;
    }

    public function setTime(string $time){
        $this->time= $time;
    }
}
