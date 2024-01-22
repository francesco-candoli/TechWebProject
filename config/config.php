<?php
//site name
define('SITE_NAME', 'your-site-name');

define('PROTOCOL', 'http://');
define('SERVER', 'localhost');
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', 'TechWebProject/');

//DB Params
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'spesagian');
define('DB_PASS', 'apetuning1');
define('DB_NAME', 'ristoranti');

$pdo = new PDO('mysql:host=localhost;dbname=ristoranti', DB_USER, DB_PASS);

