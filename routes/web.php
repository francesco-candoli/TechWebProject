<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '', array('controller' => 'PageController', 'method'=>'indexAction'), array()));
$routes->add('login', new Route(constant('URL_SUBFOLDER') . 'login/', array('controller' => 'LoginController', 'method'=>'createForm'), array()));
$routes->add('auth', new Route(constant('URL_SUBFOLDER') . 'login/auth/', array('controller' => 'LoginController', 'method'=>'fetchData'), array()));
$routes->add('register', new Route(constant('URL_SUBFOLDER'). 'login/register/{id}&{id2}', array('controller' => 'LoginController', 'method'=>'register'), array('id'=>'[0-9]', 'id2'=>'[0-9]')));
$routes->add('fornitori', new Route(constant('URL_SUBFOLDER') . 'fornitori/', array('controller' => 'FornitoriController', 'method'=>'indexAction'), array()));
$routes->add('delFornitore', new Route(constant('URL_SUBFOLDER') . 'fornitori/delete/', array('controller' => 'FornitoriController', 'method'=>'deleteFornitore'), array()));
$routes->add('addFornitore', new Route(constant('URL_SUBFOLDER') . 'fornitori/add/', array('controller' => 'FornitoriController', 'method'=>'addFornitore'), array()));
$routes->add('showOrdini', new Route(constant('URL_SUBFOLDER'). 'ordini/{codiceFornitore}', array('controller' => 'OrdiniController', 'method'=>'indexAction'), array('codiceFornitore'=>'[0-9]{2}|[0-9]{1}|[0-9]{3}|[0-9]{4}|[0-9]{5}|[0-9]{6}')));
$routes->add('createOrdine', new Route(constant('URL_SUBFOLDER'). 'ordini/create/', array('controller' => 'OrdiniController', 'method'=>'createOrder'), array()));
$routes->add('deleteRiga', new Route(constant('URL_SUBFOLDER'). 'ordini/riga/delete/{codiceRiga}', array('controller' => 'OrdiniController', 'method'=>'DeleteRiga'), array('codiceRiga'=>'[0-9]{1}|[0-9]{2}|[0-9]{3}|[0-9]{4}|[0-9]{5}|[0-9]{6}')));
$routes->add('addRiga', new Route(constant('URL_SUBFOLDER'). 'ordini/riga/add/', array('controller' => 'OrdiniController', 'method'=>'InsertRiga'), array()));
$routes->add('CheckOrdine', new Route(constant('URL_SUBFOLDER'). 'ordini/check-cod/', array('controller' => 'OrdiniController', 'method'=>'CheckCode'), array()));
$routes->add('PreviousOrders', new Route(constant('URL_SUBFOLDER'). 'ordini/history/{codiceFornitore}', array('controller' => 'OrdiniController', 'method'=>'GetPreviousOrders'), array('codiceFornitore'=>'[0-9]{2}|[0-9]{1}|[0-9]{3}|[0-9]{4}|[0-9]{5}|[0-9]{6}')));