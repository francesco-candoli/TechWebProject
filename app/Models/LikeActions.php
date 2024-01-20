<?php

namespace App\Models;

class LikeActions{
    private int $id;
    private int $user_id;
    private int $comment_id;

    function __construct(int $id, int $user_id, int $comment_id){
        $this->id=$id;
        $this->user_id=$user_id;
        $this->comment_id=$comment_id;
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
    
    public function getCommentId(){
        return $this->comment_id;
    }

    public function setCommentId(int $comment_id){
        $this->comment_id= $comment_id;
    }
}
