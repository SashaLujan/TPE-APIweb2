<?php
require_once 'libs/router.php';
require_once 'controllers/documentationController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método
$router->addRoute('documentation',        'GET',       'DocumentationController',         'showDocumentation');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);