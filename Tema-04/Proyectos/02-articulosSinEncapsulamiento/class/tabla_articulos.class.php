<?php
    /*
        Clase Tabla_articulos array de objetos de la clase articulo
    */

    class Class_tabla_articulos {
        public $articulos;

        public function __construct() {
            $this->articulos = [];
        }

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

        /*
            Método: get_indice_a_partir_id()
            descripción: obtiene el índice del array en el que se encuentra un artículo
            a partir del id

            Parámetros:
            - id: id del artículo

            Retorno:
            -índice: del array
        */
        public function get_indice_from_id($id) {
            foreach($this->articulos as $indice => $articulo) {
                if ($articulo->id == $id) {
                    return $indice;
                }
            }
            return null;
        }

        /*método: get_articulo_from_indice()
        descripción: obtiene un objeto de la clase artículo a partir del índice del array
        tabla artículos

        Parámetros:
            -indice: indice en el que se encuentra el artículo

        Retorna:
            - Objeto de la clase artículo
        */
        public function get_articulo_from_indice($indice) {
            return $this->articulos[$indice];
        }

        /*
            método: update()
            descripción: actualiza los detalles de un artículo en la tabla a partir del id de dicho artículo

            Parámetro:
            - Objeto de la clase artículo, co los detalles del artículo
            -indice del array en el que se encuentra dicho artículo
        */
        public function update(Class_articulo $articulo, $indice) {
            // 
            $this->articulos[$indice] = $articulo;

        }

        /*
            método: delete()
            descripción: elimino el artículo del array a partir del índice en el que se encuentra

            parámetros:
            -índice: indice del array en el que se encuent
        */

        public function delete($indice) {
            unset($this->articulos[$indice]);
            array_values($this->articulos);
        }

        
    }



    

?>