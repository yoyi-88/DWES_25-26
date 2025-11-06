<?php
    /*
        Ejemplo 4.4: Herencia. Definición de la subclase Coche a partir de la superclase Vehículo
        Autor: Javier Rodríguez
        Fecha: 05/1/25
    */

    class Class_coche extends Class_vehiculo{
        private $numPlazas;

        public function __construct(
            $matricula = null,
            $marca = null,
            $modelo = null,
            $velocidad = 0,
            $numPlazas = 0
        ){
            // Llamada al constructor de la superclase
            parent::__construct($matricula, $marca, $modelo, $velocidad);
            $this->numPlazas = $numPlazas;
        }

        //Getter y Setter de numPuertas
        public function get_numPlazas(){
            return $this->numPlazas;
        }
        public function set_numPlazas($numPlazas){
            $this->numPlazas = $numPlazas;
        }
    }
?>