<?php

require_once 'model.php';
class CancionesModel extends Model
{

    //muestra las canciones de una banda 
    public function getCancionesByBandas($id)
    {
        //Creamos la consulta para obtener una categoria
        $sentencia = $this->db->prepare("SELECT * FROM canciones
        WHERE id_banda_fk = ?"); // prepara la consulta
        $sentencia->execute([$id]); // ejecuta
        $cancion = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        return $cancion;
    }

    public function getAll(){

        //Creamos la consulta para obtener todos los items
        $sentencia = $this->db->prepare("SELECT * FROM canciones"); // prepara la consulta
        $sentencia->execute(); // ejecuta
        $canciones = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        return $canciones;
    }

    public function cancion($id){

        //Creamos la consulta para obtener la cancion
        $sentencia = $this->db->prepare("SELECT * FROM canciones JOIN bandas ON canciones.id_banda_fk = bandas.id_banda WHERE canciones.id_cancion = ?"); // prepara la consulta
        $sentencia->execute([$id]); // ejecuta
        $cancion = $sentencia->fetch(PDO::FETCH_OBJ); // obtiene la respuesta
        return $cancion;
    }
    public function addCancion($nombre_cancion,$letra_cancion,$genero_cancion,$id_banda){

        $sentencia = $this->db->prepare("INSERT INTO canciones(nombre_cancion, letra, genero, id_banda_fk) VALUES(?,?,?,?)"); // prepara la consulta        
        return $sentencia->execute([$nombre_cancion,$letra_cancion,$genero_cancion,$id_banda]); // ejecuta
    }
    public function editCancion($nombre_cancion,$letra_cancion,$genero_cancion,$id_banda,$id_cancion){

        $sentencia = $this->db->prepare("UPDATE canciones SET nombre_cancion =?, letra=?, genero=?, id_banda_fk=? WHERE id_cancion = ?"); // prepara la consulta        
        return $sentencia->execute([$nombre_cancion,$letra_cancion,$genero_cancion,$id_banda, $id_cancion]); // ejecuta
    }
    public function delete($id_cancion)
    {
        $sentencia = $this->db->prepare("DELETE FROM canciones  WHERE id_cancion = ?"); // prepara la consulta
        $sentencia->execute([$id_cancion]); // ejecuta 
        return $sentencia;
    }
}
