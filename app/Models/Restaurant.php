<?php

namespace App\Models;

class Restaurant{
    private int $id;
    private string $name;
    private string $address;

    function __construct(int $id,string $name, string $address){
        $this->id=$id;
        $this->name=$name;
        $this->address=$address;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName(string $name){
        $this->name= $name;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setAddress(string $address){
        $this->address= $address;
    }
}
