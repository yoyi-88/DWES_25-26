<?php 
    /*
        Clase  articulo
        Descripción: Clase articulo para gestionar artículos en una aplicación.
        Con encapsulamiento, constructor y métodos getters y setters.
    */

    class Class_articulo {
        // Propiedades privadas
        public $id;
        public $descripcion;
        public $modelo;
        public $marca;
        public $categorias;
        public $unidades;
        public $precio;

        // Constructor
        public function __construct(
            $id = null,
            $descripcion = null,
            $modelo = null,
            $marca = null,
            $categorias = [],
            $unidades = null,
            $precio = null
        ) {
            $this->id = $id;
            $this->descripcion = $descripcion;
            $this->modelo = $modelo;
            $this->marca = $marca;
            $this->categorias = $categorias;
            $this->unidades = $unidades;
            $this->precio = $precio;
        }
    
    }



?>
