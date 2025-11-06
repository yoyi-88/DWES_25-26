<?php
    /*
        Ejemplo 4.6: Uso de atributos y métodos estáticos en una clase.
    */

    class Class_pelicula {
        // Atributo estático
        public  $id;
        public $titulo;
        static public $pais = "España";

        function __construct($id = null, $titulo = null) {
            $this->id = $id;
            $this->titulo = $titulo;
        }

        // Método no estático
        public function mostrarPais() {
            return self::$pais;
        }

        // Método estático
        static public function mostrarPaisEstatico() {
            echo "País de origen: " . self::$pais . "<br>";
           
        }

        
    }
?>