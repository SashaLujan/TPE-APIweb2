<?php

require_once 'model.php';

class ComentariosModel extends Model{

    public function getAllAsc($column){
        //PDO No permite pasar identificadores ni con execute o bindParam, solo valores.
        //por lo tanto se pasa el valor de la columna desde la variable y se restringe
        //los valores admitidos desde el controlador para evitar inyecciones SQL.
        $sentencia = $this->db->prepare("SELECT * FROM comentarios ORDER BY $column ASC"); //ASC
        $sentencia->execute(); // ejecuta
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        return $comentarios;
    }

    public function getAllDesc($column){
        //PDO No permite pasar identificadores ni con execute o bindParam, solo valores.
        //por lo tanto se pasa el valor de la columna desde la variable y se restringe
        //los valores admitidos desde el controlador para evitar inyecciones SQL.
        $sentencia = $this->db->prepare("SELECT * FROM comentarios ORDER BY $column DESC"); //DESC
        $sentencia->execute(); // ejecuta
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        return $comentarios;
    }

    public function getAllpaginated($offset,$limit){
        $sentencia = $this->db->prepare("SELECT * FROM comentarios LIMIT :limit OFFSET :offset"); // prepara la consulta
        $sentencia->bindParam(':limit', $limit , PDO::PARAM_INT);
        $sentencia->bindParam(':offset', $offset , PDO::PARAM_INT);
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

    //trae un comentario por id
    public function getComentario($id_comentario){
      $sentencia = $this->db->prepare("SELECT * FROM comentarios WHERE id_comentario=?");
      $sentencia->execute([$id_comentario]);
      $comentario = $sentencia->fetch(PDO::FETCH_OBJ);
      return $comentario;
    }

    //crea un comentario
    public function crearComentario($autor, $positivo, $comentario, $id_cancion){
        $sentencia = $this->db->prepare("INSERT INTO comentarios (autor, positivo, comentario, id_cancion) VALUES (?,?,?,?)");
        return $sentencia->execute([$autor, $positivo, $comentario, $id_cancion]);
    }
}