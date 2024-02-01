<?php

namespace App\Models;

class User{
    private int $id;
    private string $username;
    private string $password;
    private string $profile_image_src;
    private int $age;
    private string $sex;
    private string $salt;

    function __construct(int $id,string $username, string $password,string $profile_image_src ,int $age, string $sex, string $salt){
        $this->id=$id;
        $this->username=$username;
        $this->password=$password;
        $this->profile_image_src=$profile_image_src;
        $this->age=$age;
        $this->sex=$sex;
        $this->salt=$salt;
    }

    public function getSalt(){
        return $this->salt;
    }

    public function setSalt(string $salt){
        $this->salt= $salt;
    }

    public function getID(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getProfileImageSrc(){
        return $this->profile_image_src;
    }

    public function getAge(){
        return $this->age;
    }

    public function getSex(){
        return $this->sex;
    }

    public function setUsername(string $username){
        $this->username = $username;
    }

    public function setPassword(string $plainTextPassword){
        // Crea una password usando la chiave appena creata.
        $encryptedPassword = hash('sha512', $plainTextPassword.$this->getSalt());
        $this->password = $encryptedPassword;
    }

    public function setProfileImageSrc(string $profile_image_src){
        $this->profile_image_src = $profile_image_src;
    }

    public function setAge(int $age){
        $this->age = $age;
    }

    public function setSex(string $sex){
        $this->sex = $sex;
    }
}