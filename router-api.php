<?php
require_once("libs/Router.php");
require_once("api/controller/api.controller.php");

$router = new Router();

$router->addRoute('products', 'GET', 'tyresApiController', 'getAllProducts');
$router->addRoute('paginacion', 'GET', 'tyresApiController', 'pagination');
$router->addRoute('comments/:ID', 'GET', 'tyresApiController', 'getAllComments');
$router->addRoute('comments', 'POST', 'tyresApiController', 'sendComment');
$router->addRoute('comments/:ID', 'DELETE', 'tyresApiController', 'deleteComment');
$router->addRoute('getSearch/:ID', 'GET', 'tyresApiController', 'getSearch');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
