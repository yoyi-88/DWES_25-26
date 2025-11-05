<?php 
    /*
        Ejemplo 4.1: Definición de la clase vehículo
    */
    Class Class_vehiculo { 
    
        // Atributos o propiedades
        public $matricula;
        public $marca;
        public $modelo;
        public $velocidad;

        // Método constructor
        // Inicializa los atributos del vehículo
        public function __construct() {
            $this->matricula = null;
            $this->marca = null;
            $this->modelo = null;
            $this->velocidad = null;


        }
        
            
        // Metodos getters y setters
        // Obtener matrícula
        public function get_matricula() {
            return $this->matricula;
        }

        public function set_matricula($matricula) {
            $this->matricula = $matricula;
        }
        // Obtener marca
        public function get_marca() {
            return $this->marca;
        }

        public function set_marca($marca) {
            $this->marca = $marca;
        }
        // Obtener modelo
        public function get_modelo() {
            return $this->modelo;
        }
        public function set_modelo($modelo) {
            $this->modelo = $modelo;
        }
        // Obtener velocidad
        public function get_velocidad() {
            return $this->velocidad;
        }
        public function set_velocidad($velocidad) {
            $this->velocidad = $velocidad;
        }
    }

?>