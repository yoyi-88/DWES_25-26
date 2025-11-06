<?php
    /*
        Ejemplo 4.4: Herencia. Definición de la subclase Coche a partir de la superclase Vehículo
        Autor: Javier Rodríguez
        Fecha: 05/1/25
    */

    class Class_coche extends Class_vehiculo{
        private $numPuertas;

        //Getter y Setter de numPuertas
        public function get_numPuertas(){
            return $this->numPuertas;
        }
        public function set_numPuertas($numPuertas){
            $this->numPuertas = $numPuertas;
        }
    }
?>