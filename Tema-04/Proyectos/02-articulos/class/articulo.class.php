<?php 
    /*
        Clase  articulo
        Descripción: Clase articulo para gestionar artículos en una aplicación.
        Con encapsulamiento, constructor y métodos getters y setters.
    */

    class Class_articulo {
        // Propiedades privadas
        private $id;
        private $descripcion;
        private $modelo;
        private $marca;
        private $categorias;
        private $unidades;
        private $precio;

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
    
    

        /**
         * Get the value of unidades
         */ 
        public function getUnidades()
        {
                return $this->unidades;
        }

        /**
         * Set the value of unidades
         *
         * @return  self
         */ 
        public function setUnidades($unidades)
        {
                $this->unidades = $unidades;

                return $this;
        }

        /**
         * Get the value of precio
         */ 
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         *
         * @return  self
         */ 
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

        /**
         * Get the value of categorias
         */ 
        public function getCategorias()
        {
                return $this->categorias;
        }

        /**
         * Set the value of categorias
         *
         * @return  self
         */ 
        public function setCategorias($categorias)
        {
                $this->categorias = $categorias;

                return $this;
        }

        /**
         * Get the value of marca
         */ 
        public function getMarca()
        {
                return $this->marca;
        }

        /**
         * Set the value of marca
         *
         * @return  self
         */ 
        public function setMarca($marca)
        {
                $this->marca = $marca;

                return $this;
        }

        /**
         * Get the value of modelo
         */ 
        public function getModelo()
        {
                return $this->modelo;
        }

        /**
         * Set the value of modelo
         *
         * @return  self
         */ 
        public function setModelo($modelo)
        {
                $this->modelo = $modelo;

                return $this;
        }

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
    }



?>
