<?php 
    /*
        Clase  articulo
        Descripción: Clase articulo para gestionar artículos en una aplicación.
        Con encapsulamiento, constructor y métodos getters y setters.
    */

    class Class_alumno {
        // Propiedades privadas
        public $id;
        public $nombre;
        public $apellidos;
        public $email;
        public $f_nacimiento;
        public $curso;
        public $asignaturas;

        // Constructor
        public function __construct(
            $id = null,
            $nombre = null,
            $apellidos = null,
            $email = null,
            $f_nacimiento = null,
            $curso = null,
            $asignaturas = []
        ) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->f_nacimiento = $f_nacimiento;
            $this->curso = $curso;
            $this->asignaturas = $asignaturas;
        }
        


        public function getEdad($f_nacimiento) {
                $fechaActual = new DateTime('now');
                $diferencia = $f_nacimiento->diff($fechaActual);
                return $diferencia->y; 

        }
    }



?>
