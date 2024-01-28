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
$routes->add('like/add/{user_id_review_id}', new Route(constant('URL_SUBFOLDER') . 'like/add/{user_id_review_id}', array('controller' => 'LikeController', 'method'=>'add'), array('user_id_review_id'=>'.*')));
$routes->add('like/delete/{like_id}', new Route(constant('URL_SUBFOLDER') . 'like/delete/{like_id}', array('controller' => 'LikeController', 'method'=>'delete'), array('like_id'=>'.*')));