<?php

require_once 'model.php';

class UsuarioModel extends Model{

    public function getUsuario($user){

        $sentencia = $this->db->prepare("SELECT * FROM usuarios = ?"); // prepara la consulta
        $sentencia->execute([$user]); // ejecuta
        $usuario = $sentencia->fetch(PDO::FETCH_OBJ); // obtiene la respuesta
        return $usuario;
    }
}
