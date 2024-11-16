<?php
require_once 'views/api.view.php';
require_once 'models/usuario.model.php';

class TokenApiController
{

    private $view;
    private $modelUsuario;

    public function __constructor()
    {
        $this->view = new APIView();
        $this->modelUsuario = new UsuarioModel();
    }

    public function getToken() {}

    public function auth_basic()
    {
        //controla que los datos ingresados sean validos
        if(!isset($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_USER'])){
            return $this->view->response("Ingrese usuario válido", 401);
        }
        if(!isset($_SERVER['PHP_AUTH_PW']) || empty($_SERVER['PHP_AUTH_PW'])){
            return $this->view->response("Ingrese contraseña válida", 401);
        }

        try {
            $usuario = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];

            return $this->autenticar($usuario, $password);
        } catch (\Throwable $th) {
            echo ($th);
            return;
        }
    }

    private function autenticar($usuario, $password)
    {
        //busca el usuario
        $user = $this->modelUsuario->getUsuario($usuario);

        if ($user && password_verify($password, ($user->password))) {
            return true;
        }
        return false;
    }


}
