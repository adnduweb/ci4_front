<?php 


$routes->get('/', '\Adnduweb\Ci4Front\Controllers\Front\Home::index'); 
$routes->get('/api/customer/list','\Adnduweb\Ci4Front\Controllers\Front\Home::list');
$routes->get('/api/customer/test', '\Adnduweb\Ci4Front\Controllers\Front\Home::test');