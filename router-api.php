<?php
require_once("libs/Router.php");
require_once("api/controller/tyresApiController.php");


$router = new Router();

//define tabla
$router->addRoute('products', 'GET', 'tyresApiController', 'getAllProducts');
$router->addRoute('product/:ID', 'GET', 'tyresApiController', 'getProduct');
$router->addRoute('paginacion', 'GET', 'tyresApiController', 'pagination');
$router->addRoute('comments', 'GET', 'tyresApiController', 'getAllComments');
$router->addRoute('comments/product/:ID', 'GET', 'tyresApiController', 'getAllCommentsByProduct');
$router->addRoute('comments', 'POST', 'tyresApiController', 'sendComment');
$router->addRoute('comments/:ID', 'DELETE', 'tyresApiController', 'deleteComment');
// $router->addRoute('getSearch/:ID', 'GET', 'tyresApiController', 'getSearch');


//rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
