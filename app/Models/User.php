<?php

namespace App\Models;

class User{
    private int $id;
    private string $username;
    private string $password;
    private int $age;
    private string $sex;
    private string $salt;

    function __construct(int $id,string $username, string $password, int $age, string $sex, string $salt){
        $this->id=$id;
        $this->username=$username;
        $this->password=$password;
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
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        // Crea una password usando la chiave appena creata.
        $encryptedPassword = hash('sha512', $plainTextPassword.$random_salt);
        $this->password = $encryptedPassword;
    }

    public function setAge(int $age){
        $this->age = $age;
    }

    public function setSex(string $sex){
        $this->sex = $sex;
    }
}