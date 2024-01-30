<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '', array('controller' => 'HomeController', 'method'=>'indexAction'), array()));
$routes->add('profile', new Route(constant('URL_SUBFOLDER') . 'profile/{username}', array('controller' => 'ProfileController', 'method'=>'indexAction'), array('username'=>'.*')));
$routes->add('processLogin', new Route(constant('URL_SUBFOLDER') . 'processLogin', array('controller' => 'LoginController', 'method'=>'login'), array()));
$routes->add('login', new Route(constant('URL_SUBFOLDER') . 'login', array('controller' => 'LoginController', 'method'=>'index'), array()));
$routes->add('logout', new Route(constant('URL_SUBFOLDER') . 'logout', array('controller' => 'LoginController', 'method'=>'logout'), array()));
$routes->add('test', new Route(constant('URL_SUBFOLDER'). 'test/service', array('controller' => 'TestController', 'method'=>'index'), array()));
$routes->add('notifications', new Route(constant('URL_SUBFOLDER') . 'notifications', array('controller' => 'NotificationController', 'method'=>'index'), array()));
$routes->add('notifications/delete/{notification_id}', new Route(constant('URL_SUBFOLDER') . 'notifications/delete/{notification_id}', array('controller' => 'NotificationController', 'method'=>'delete'), array('notification_id'=>'.*')));
$routes->add('like/changeStatus/{user_id_review_id}', new Route(constant('URL_SUBFOLDER') . 'like/changeStatus/{user_id_review_id}', array('controller' => 'LikeController', 'method'=>'index'), array('user_id_review_id'=>'.*')));
$routes->add('follow/changeStatus/{user_id}', new Route(constant('URL_SUBFOLDER') . 'follow/changeStatus/{user_id}', array('controller' => 'ProfileController', 'method'=>'changeFollowStatus'), array('user_id'=>'.*')));
$routes->add('upload', new Route(constant('URL_SUBFOLDER') . 'upload', array('controller' => 'UploadController', 'method'=>'index'), array()));
$routes->add('processUpload', new Route(constant('URL_SUBFOLDER') . 'processUpload', array('controller' => 'UploadController', 'method'=>'uploadResources'), array()));
