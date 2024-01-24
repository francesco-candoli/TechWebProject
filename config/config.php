<?php
//site name
define('SITE_NAME', 'your-site-name');

define('PROTOCOL', 'http://');
define('SERVER', 'localhost');
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', 'ristoranti/TechWebProject/');

//DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_NAME', 'ristoranti');

$pdo = new PDO('mysql:host=localhost;port=3307;dbname=ristoranti', DB_USER, DB_PASS);
