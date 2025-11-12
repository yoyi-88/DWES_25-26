<?php
    /*
        Clase Tabla_articulos array de objetos de la clase articulo
    */

    class Class_tabla_articulos {
        private $articulos;

        public function __construct() {
            $this->articulos = [];
        }

        public function get_articulos() {
            return $this->articulos;
        }
        
        /**
         * Set the value of articulos
         *
         * @return  self
         */ 
        public function setArticulos($articulos)
        {
                $this->articulos = $articulos;

                return $this;
        }

        


        static public function get_marcas() {
            return ["Huawei", "Samsung", "Xiaomi", "Apple", "OnePlus", "Dell", "HP", "Lenovo"];
        }

        static public function get_Categorias() {
            return ["Impresoras", "Portátiles", "Smartphones", "Tablets", "Accesorios", "Electrónica", "Periféricos", "Redes"];
        }

        public function get_datos() {
            // creamos algunos artículos de ejemplo (la categoria y marca deben estar en los arrays estáticos y ponerse mediante sus numeros índices, además un artículo puede pertenecer a varias categorías)
            $articulo = new Class_articulo(1, "Portátil", "Inspiron 15", 6, [1, 5], 10, 599.99);
            $this->articulos[] = $articulo;
            $articulo = new Class_articulo(2, "Smartphone", "Galaxy S21", 1, [3, 6], 15, 799.99);
            $this->articulos[] = $articulo;
            $articulo = new Class_articulo(3, "Tablet", "iPad Air", 4, [3, 2], 8, 649.99);
            $this->articulos[] = $articulo;
            $articulo = new Class_articulo(4, "Impresora", "LaserJet Pro", 5, [1, 7], 12, 299.99);
            $this->articulos[] = $articulo;
            $articulo = new Class_articulo(5, "Accesorio", "AirPods Pro", 4, [3, 6], 20, 249.99);
            $this->articulos[] = $articulo;

            
            
        }
        // 
        
        /*
        Convertir array de indices de categorías a sus nombres de categorías
        Parámetros:
            - $indices: array de índices de categorías
        */ 
        static public function categorias_indices_a_nombres($indices) {
            $todas_categorias = self::get_Categorias();

            // array donde guardaremos los nombres de las categorías
            $nombres_categorias = [];

            foreach ($indices as $indice) {
                
                $nombres_categorias[] = $todas_categorias[$indice];
                
            }
            return $nombres_categorias;
        }

        /*Método: create()
        Añade un nuevo artículo
        Parámetros: objeto de la clase artículo  */

        public function create(Class_articulo $articulo) {
            $this->articulos[] = $articulo;
        }

        
    }



    

?>