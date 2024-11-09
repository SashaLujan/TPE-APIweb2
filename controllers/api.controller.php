<?php

require_once 'models/comentarios.model.php';
require_once 'models/canciones.model.php'
require_once 'api.view.php';

class ApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->modelComentarios = new ComentariosModel();
        $this->modelCanciones = new CancionesModel();
        $this->view = new APIView();
    }

    public function getAll(){

        $comentarios = $this->modelComentarios->getAll();
        return $this->view->response($comentarios, 200);
    }

    public function getAllByCancion($req){

        $id_cancion = $req->params->id;
        $cancion = $this->modelCanciones->cancion($id_cancion);
        if(!empty($cancion)){
            
            $comentarios = $this->modelComentarios->getAllByCancion($id_cancion);
            return $this->view->response($comentarios, 200);
        }else{

            return $this->view->response("No existe la canción con id: " . $id_cancion, 404);
        }

    }

    public function update($req){

        $id_comentario = $req->params->id;
        $comentario = $this->modelComentarios->getComentario($id_comentario);

        if(!$comentario){
            return $this->view->response("No existe comentario con id = $id_comentario", 404);
        }

        $autor = $req->body->autor;
        $positivo = $req->body->positivo;
        $comentario = $req->body->comentario;

        if(empty($autor) || empty($positivo) || empty($comentario)){
            return $this->view->response("Faltan completar campos", 401);
        }

        $editado = $this->model->updateComentario($autor, $positivo, $comentario, $id_comentario);

        return $this->view->response($editado, 200);

    }


}