<?php

    class Responsable{

        private $idUsuario;
        private $nombre;
        private $firma;

        public function __construct($id, $nombre, $firma){
            $this->idUsuario = $id;
            $this->nombre = $nombre;
            $this->firma = $firma;
        }

        public function setIdUsuario($id){
            $this->idUsuario = $id;
        }

        public function getIdUsuario(){
            return $this->idUsuario;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setFirma($firma){
            $this->firma = $firma;
        }

        public function getFirma(){
            return $this->firma;
        }

    }

?>