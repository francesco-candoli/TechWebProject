<?php

namespace App\Models;

class Notification{
    private int $id;
    private string $content;
    private string $url;

    function __construct(int $id,string $content, string $url){
        $this->id=$id;
        $this->content=$content;
        $this->url=$url;
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

    public function getUrl(){
        return $this->url;
    }

    public function setUrl(string $url){
        $this->url= $url;
    }
}
