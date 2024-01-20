<?php

namespace App\Models;

class Review{
    private int $id;
    private string $content;
    private int $vote;
    private int $restaurant_id;
    private int $publisher_id;

    function __construct(int $id, string $content, int $vote, int $restaurant_id, int $publisher_id){
        $this->id=$id;
        $this->content=$content;
        $this->vote=$vote;
        $this->restaurant_id=$restaurant_id;
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

    public function getVote(){
        return $this->vote;
    }

    public function setVote(int $vote){
        $this->vote= $vote;
    }

    public function getRestaurantId(){
        return $this->restaurant_id;
    }

    public function setRestaurantId(int $restaurant_id){
        $this->restaurant_id= $restaurant_id;
    }
    
    public function getPublisherId(){
        return $this->publisher_id;
    }

    public function setPublisherId(int $publisher_id){
        $this->publisher_id= $publisher_id;
    }
}
