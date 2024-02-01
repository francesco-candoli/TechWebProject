<?php
//site name
define('SITE_NAME', 'your-site-name');

define('PROTOCOL', 'http://');
define('SERVER', 'localhost');
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', 'ristoranti/TechWebProject/');
define('REVIEW_IMAGE_PATH','public/images/review/');
define('PROFILE_IMAGE_PATH','public/images/profile/');

define('DEFAULT_PROFILE_IMAGE','1.jpg');


//DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'checco');
define('DB_PASS', 'Password');
define('DB_NAME', 'ristoranti');

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=ristoranti', DB_USER, DB_PASS);
