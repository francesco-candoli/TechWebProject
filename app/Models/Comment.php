<?php

namespace App\Models;

class Comment{
    private int $id;
    private string $content;
    private int $review_id;
    private int $publisher_id;

    function __construct(int $id, string $content, int $review_id, int $publisher_id){
        $this->id=$id;
        $this->content=$content;
        $this->review_id=$review_id;
        $this->publisher_id=$publisher_id;
    }

    public function getId(){
        return $this->id;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent(string $content){
        $this->content= $content;
    }

    public function getReviewId(){
        return $this->review_id;
    }

    public function setReviewId(int $review_id){
        $this->review_id= $review_id;
    }
    
    public function getPublisherId(){
        return $this->publisher_id;
    }

    public function setPublisherId(int $publisher_id){
        $this->publisher_id= $publisher_id;
    }
}
