<?php

include 'db2.php';

class User extends DB{
    
    private $id;
    private $nombre;
    private $username;
    private $tipo;
    private $idAuxiliar;
    private $primerNombre;

    public function userExist($user, $pass){
        $query = "SELECT * from empleados WHERE usuario = '$user' AND pass = '$pass' ";
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE usuario = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }

    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE usuario = :user');
        $query->execute(['user' => $user]);

        foreach($query as $currentUser){
            $this->id = $currentUser['idUsuario'];
            $this->nombre = $currentUser['paterno']." ".$currentUser['materno']." ".$currentUser['nombres'];
            $this->username = $currentUser['usuario'];
            $this->tipo = $currentUser['tipo'];
            $this->primerNombre = $currentUser['nombres'];
        }
    }

    public function getIdUsuario(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getPrimerNombre(){
        return $this->primerNombre;
    }

    public function getPaterno(){
        return $currentUser['paterno'];
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setIdAuxiliar($idAux){
        $this->idAuxiliar = $idAux;
    }

    public function getIdAuxiliar(){
        return $this->idAuxiliar;
    }

}

?>