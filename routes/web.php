<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '', array('controller' => 'PageController', 'method'=>'indexAction'), array()));

//$routes->add('PreviousOrders', new Route(constant('URL_SUBFOLDER'). 'ordini/history/{codiceFornitore}', array('controller' => 'OrdiniController', 'method'=>'GetPreviousOrders'), array('codiceFornitore'=>'[0-9]{2}|[0-9]{1}|[0-9]{3}|[0-9]{4}|[0-9]{5}|[0-9]{6}')));