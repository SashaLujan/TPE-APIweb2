<?php
require_once 'libs/router.php';
require_once 'controllers/api.controller.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);