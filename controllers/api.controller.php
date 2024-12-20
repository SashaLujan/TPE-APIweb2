<?php

require_once 'models/comentarios.model.php';
require_once 'models/canciones.model.php';
require_once 'views/api.view.php';

class ApiController {

    private $modelCanciones;
    private $modelComentarios;
    private $view;

    public function __construct() {
        
        $this->modelComentarios = new ComentariosModel();
        $this->modelCanciones = new CancionesModel();
        $this->view = new APIView();
    }

    public function getAll($req){

        $query = $req->query;

        if(isset($query->page) && isset($query->limit)){ //paginacion

            $this->getAllpaginated($query);

        }elseif(isset($query->order)){ //ordena asc o desc
            
            if($query->order == "asc") {

                $this->getAllAsc($query);

            } elseif($query->order == "desc"){

                $this->getAllDesc($query);

            } 
            else {
                return $this->view->response("Valor de 'order' invalido ", 400);
            }
        }
        elseif (isset($query->positivo)) { // Filtro por campo positivo
            if ($query->positivo === "1" || $query->positivo === "0") { // Validar valores aceptados
                $this->getAllByPositivo($query);
            } else {
                return $this->view->response("El parámetro 'positivo' debe ser 1 o 0", 400);
            }
        }
        else { // Sin parámetros, orden ascendente por defecto
            $this->getAllAsc($query);
        }

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
        $id_cancion = $req->body->id_cancion;

    
        if(empty($autor) || empty($comentario) || empty($id_cancion) || !isset($positivo) || ($positivo != true && $positivo != false)){
            return $this->view->response("Debe completar todos los campos asegurandose a su vez que el valor de positivo sea true o false", 400);
        }

        $existeCancion = $this->modelCanciones->cancion($id_cancion);

        if(!$existeCancion){
            return $this->view->response("No existe la cancion", 404);
        }

        $editado = $this->modelComentarios->updateComentario($autor, $positivo, $comentario, $id_cancion, $id_comentario);

        return $this->view->response($editado, 200);

    }

    private function checkColumn($column) {

        $opcionesValidasColumn = ["id_comentario","autor","positivo","comentario","id_cancion_fk"];

        // Verifica que la columna esté en la lista blanca
        if (!in_array($column, $opcionesValidasColumn)) {
            return false;
        } else {
            return true;
        }
    }

    private function getAllAsc($query) {

        if(isset($query->column)){
            $valido = $this->checkColumn($query->column);
            if($valido) {
                $comentarios = $this->modelComentarios->getAllAsc($query->column);
            } else {
                return $this->view->response("Valor de parametro column invalido", 400);
            }
        } else {
            $comentarios = $this->modelComentarios->getAllAsc("id_comentario");
        }

        return $this->view->response($comentarios, 200);
    }

    private function getAllDesc($query){

        if(isset($query->column)){
            $valido = $this->checkColumn($query->column);
            if($valido) {
                $comentarios = $this->modelComentarios->getAllDesc($query->column);
            } else {
                return $this->view->response("Valor de parametro column invalido", 400);
            }
        } else {
            $comentarios = $this->modelComentarios->getAllDesc("id_comentario");
        }

        return $this->view->response($comentarios, 200);
    }

    private function getAllpaginated($query){

        $page = (int)$query->page;
        $limit = (int)$query->limit;
        $offset = ($page-1) * $limit;

        if ($page < 1 || $limit < 1){
            return $this->view->response("Los parametros page y limit deben ser enteros y mayores o iguales a 1", 400);
        }
        $comentarios = $this->modelComentarios->getAllpaginated($offset,$limit);

        if(empty($comentarios)){
            return $this->view->response("No hay comentarios en la página $page", 404);
        }else{
            return $this->view->response($comentarios, 200);
        }
    }

    private function getAllByPositivo($query) {
        $isPositive = ($query->positivo === "1") ? 1 : 0; // convierte a booleano
        $comentarios = $this->modelComentarios->getAllFilter($isPositive);
    
        if (empty($comentarios)) {
            return $this->view->response("No hay comentarios que coincidan con el filtro aplicado", 404);
        } else {
            return $this->view->response($comentarios, 200);
        }
    }

    //obtiene un comentario por id
    public function getCommentById($req){
        $id_comentario = $req->params->id;

        $comentario = $this->modelComentarios->getComentario($id_comentario);

        if(!$comentario){
            return $this->view->response("No existe el comentario con el id : $id_comentario", 404);
        }
        return $this->view->response($comentario, 200);
    }

    //crear un comentario
    public function create($req){
        $autor = $req->body->autor;
        $positivo = $req->body->positivo;
        $comentario = $req->body->comentario;
        $id_cancion = $req->body->id_cancion;

        if(empty($autor) || !isset($positivo) || empty($comentario) || empty($id_cancion)){ //el autor puede ser anonimo
            return $this->view->response("Faltan completar campos", 400);
        }
        
        $existeCancion = $this->modelCanciones->cancion($id_cancion);

        if(!$existeCancion){
            return $this->view->response("No existe la cancion", 404);
        }
        
        $comentario = $this->modelComentarios->crearComentario($autor,$positivo, $comentario, $id_cancion);

        return $this->view->response($comentario, 200);
    }
    
}
