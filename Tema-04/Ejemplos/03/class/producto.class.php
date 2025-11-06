<?php
    /*
        Ej 4.2: Definición de una clase Producto Con encapsulamiento
                Todos los atributos son privados.
                Constructor por defecto.
        Autor: Javier Rodríguez
        Fecha: 05/11/2025
    */
    
    class Class_producto{
        // Atributos
        private $nombre;
        private $precio;
        private $cantidad;

        // Constructor (permite construir un objeto por defecto, haciendo que los parámetros sean opcionales):
        public function __construct(
            $nombre = null, 
            $precio = null, 
            $cantidad = 0
            ) {
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->cantidad = $cantidad;
        }

        public function get_nombre(){
            return $this->nombre;
        }

        public function set_nombre($nombre){
            $this->nombre = $nombre;
        }

        public function get_precio(){
            return $this->precio;
        }

        public function set_precio($precio){
            $this->precio = $precio;
        }

        public function get_cantidad(){
            return $this->cantidad;
        }

        public function set_cantidad($cantidad){
            $this->cantidad = $cantidad;
        }



    }
?>