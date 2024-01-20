<?php

Namespace App\Models;

class Photo{
    private int $id;
    private string $src;
    private string $alt;
    private int $review_id;

    function __construct(int $id, string $src, string $alt, int $review_id){
        $this->id=$id;
        $this->src=$src;
        $this->alt=$alt;
        $this->review_id=$review_id;
    }

    public function getId(){
        return $this->id;
    }

    public function getSrc(){
        return $this->src;
    }

    public function setSrc(string $src){
        $this->src= $src;
    }

    public function getAlt(){
        return $this->alt;
    }

    public function setAlt(string $alt){
        $this->alt= $alt;
    }

    public function getReviewId(){
        return $this->review_id;
    }

    public function setReviewId(int $review_id){
        $this->review_id= $review_id;
    }
}
