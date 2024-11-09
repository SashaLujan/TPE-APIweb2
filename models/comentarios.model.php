<?php

require_once 'model.php';

class ComentariosModel extends Model{

    public function getAll(){

        $sentencia = $this->db->prepare("SELECT * FROM comentarios"); // prepara la consulta
        $sentencia->execute(); // ejecuta
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        return $comentarios;
    }

    public function getAllByCancion($id_cancion){
        $sentencia = $this->db->prepare("SELECT * FROM comentarios WHERE id_cancion_fk=? "); // prepara la consulta
        $sentencia->execute([$id_cancion]); // ejecuta
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        return $comentarios;
    }

    public function updateComentario($autor, $positivo, $comentario, $id_cancion, $id_comentario){
        $sentencia = $this->db->prepare("UPDATE comentarios SET autor=?, positivo=?, comentario=?, id_cancion_fk=? WHERE id_comentario=?"); // prepara la consulta
        return $sentencia->execute([$autor, $positivo, $comentario, $id_cancion, $id_comentario]); // ejecuta
    }

    public function getComentario($id_comentario){
        
    }
}