<?php
    /*
        Clase: class_alumno
        descripción: clase con propiedades extraídas de las columnas de la tabla alumnos de fp
    */

    class class_alumno {
        public $id;
        public $nombre;
        public $apellidos;
        public $email;
        public $telefono;
        public $nacionalidad;
        public $dni;
        public $fecha_nac;
        public $curso_id;


        public function __construct(
            $id = null,
            $nombre = null,
            $apellidos = null,
            $email = null,
            $telefono = null,
            $nacionalidad = null,
            $dni = null,
            $fecha_nac = null,
            $curso_id = null
        ) 
        {
            $this->id = $id;
            $this->nombre = $id;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->nacionalidad = $nacionalidad;
            $this->dni = $dni;
            $this->fecha_nac = $fecha_nac;
            $this->curso_id = $curso_id;
        }

        /*
            fución: edad()
            descripción: devuelve la edad a partir de la fecha de nacimiento
        */

        public function edad() {
            $fecha_actual = new DateTime(); // Fecha actual
            $fecha_nacimiento = new DateTime($this->fecha_nac); // Fecha nacimiento
            $edad = $fecha_nacimiento->diff($fecha_actual);
            return $edad->y;
        }

        
        
    }

    

?>