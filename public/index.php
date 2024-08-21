<?php
require_once '../app/Core/Router.php';

$router = new Router();
$router->add('carne/{id}', 'GET', 'CarneController@get');
$router->add('carne/create', 'POST', 'CarneController@create');
$router->run();