<?php
    /*
        Ejemplo 4.1: Definición de una clase Vehículo en PHP
        Autor: Javier Rodríguez
        Fecha: 05/11/2025
    */
    
    class Class_vehiculo{
        // Atributos
        public $matricula;
        public $marca;
        public $modelo;
        public $velocidad;

        //Constructor (inicializa los atributos):
        public function __construct(){
            $this->matricula = null;
            $this->marca = null;
            $this->modelo = null;
            $this->velocidad = 0;
        }

        // Getters (obtener) y Setters (establecer/actualizar) (cuando haya encapsulamiento):
        public function get_matricula(){
            return $this->matricula;
        }
        public function set_matricula($matricula){
            $this->matricula = $matricula;
        }
        public function get_marca(){
            return $this->marca;
        }
        public function set_marca($marca){
            $this->marca = $marca;
        }
        public function get_modelo(){
            return $this->modelo;
        }
        public function set_modelo($modelo){
            $this->modelo = $modelo;
        }
        public function get_velocidad(){
            return $this->velocidad;
        }
        public function set_velocidad($velocidad){
            $this->velocidad = $velocidad;
        }


    }
?>