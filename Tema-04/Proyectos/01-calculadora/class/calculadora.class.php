<?php 
    /*
        Clase  calculadora
        Descripción: Esta clase proporciona métodos básicos de una calculadora.
        Con encapsulamiento.
    */

    class Class_calculadora {
        // Propiedades privadas
        private $valor1;
        private $valor2;
        private $operacion;
        private $resultado;

        // Constructor
        public function __construct($valor1 = 0, $valor2 = 0, $operacion = null, $resultado = 0) {
            $this->valor1 = $valor1;
            $this->valor2 = $valor2;
            $this->operacion = $operacion;
            $this->resultado = $resultado;
        }

        // Método para sumar dos números
        public function sumar() {
            $this->resultado = $this->valor1 + $this->valor2;
            return $this->resultado;
        }

        // Método para restar dos números
        public function restar() {
            $this->resultado = $this->valor1 - $this->valor2;
            return $this->resultado;
        }

        // Método para multiplicar dos números
        public function multiplicar() {
            $this->resultado = $this->valor1 * $this->valor2;
            return $this->resultado;
        }

        // Método para dividir dos números
        public function dividir() { 
            if ($this->valor2 != 0) {
                $this->resultado = $this->valor1 / $this->valor2;
            } else {
                $this->resultado = "Error: División por cero.";
            }
            return $this->resultado;
        }

        // Método para mostrar el resultado
        public function mostrarResultado() {
            return $this->resultado;
        }

        // Getters y Setters
        public function getValor1() {
            return $this->valor1;
        }
        public function setValor1($valor1) {
            $this->valor1 = $valor1;
        }
        public function getValor2() {
            return $this->valor2;
        }
        public function setValor2($valor2) {
            $this->valor2 = $valor2;
        }
        public function getOperacion() {
            return $this->operacion;
        }
        public function setOperacion($operacion) {
            $this->operacion = $operacion;
        }
        public function getResultado() {
            return $this->resultado;
        }
        public function setResultado($resultado) {
            $this->resultado = $resultado;
        }

    }






?>