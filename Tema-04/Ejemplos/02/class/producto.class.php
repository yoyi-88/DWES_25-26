<?php
    /*
        Ej 4.2: Definición de una clase Producto sin encapsulamiento
                Todos los atributos y métodos son públicos
                Constructor por defecto.
        Autor: Javier Rodríguez
        Fecha: 05/11/2025
    */
    
    class Class_producto{
        // Atributos
        public $nombre;
        public $precio;
        public $cantidad;

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


    }
?>