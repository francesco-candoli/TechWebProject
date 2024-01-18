<?php
use App\Authentication\Session;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


// Autoloader
require_once '../vendor/autoload.php';

// Load Config
require_once '../config/config.php';

Session::sec_session_start();

// Routes
require_once '../routes/web.php';
require_once '../app/Router.php';


