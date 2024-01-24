<?php

namespace App\Models;

class LikeActions{
    private int $id;
    private int $user_id;
    private int $review_id;

    function __construct(int $id, int $user_id, int $review_id){
        $this->id=$id;
        $this->user_id=$user_id;
        $this->review_id=$review_id;
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
    
    public function getReviewId(){
        return $this->review_id;
    }

    public function setReviewId(int $review_id){
        $this->review_id= $review_id;
    }
}
