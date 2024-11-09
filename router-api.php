<?php
require_once 'libs/router.php';
require_once 'controllers/api.controller.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método
$router->addRoute('canciones/:id/comentarios',        'GET',       'ApiController',         'getAllByCancion');
$router->addRoute('comentarios',                      'GET',       'ApiController',         'getAll');
$router->addRoute('comentarios/:id',                  'PUT',       'ApiController',         'update');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);