<?php

namespace App\Services;

use PDO;

class DatabaseService{

    protected $connection;

    function __construct(){
        $this->connection= new PDO('mysql:host=localhost;dbname=ristoranti', DB_USER, DB_PASS);
    }
}