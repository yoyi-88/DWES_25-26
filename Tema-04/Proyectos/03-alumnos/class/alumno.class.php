<?php 
    /*
        Clase  articulo
        Descripción: Clase articulo para gestionar artículos en una aplicación.
        Con encapsulamiento, constructor y métodos getters y setters.
    */

    class Class_alumno {
        // Propiedades privadas
        private $id;
        private $nombre;
        private $apellidos;
        private $email;
        private $f_nacimiento;
        private $curso;
        private $asignaturas;

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
    
    
        // Métodos estáticos
        
        static public function get_curso() {
            return ["1SMR", "2SMR", "1DAW", "2DAW", "1AD", "2AD"];
        }

        static public function get_Asignaturas() {
            return ["DWES", "DIWEB", "Proyecto", "DWECL", "Inglés Profesional", "DAH", "IPE II", "Redes"];
        }

        public function getEdad($f_nacimiento) {
                $fechaActual = new DateTime('now');
                $diferencia = $f_nacimiento->diff($fechaActual);
                return $diferencia->y; 

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

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellidos
         */ 
        public function getApellidos()
        {
                return $this->apellidos;
        }

        /**
         * Set the value of apellidos
         *
         * @return  self
         */ 
        public function setApellidos($apellidos)
        {
                $this->apellidos = $apellidos;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of f_nacimiento
         */ 
        public function getF_nacimiento()
        {
                return $this->f_nacimiento;
        }

        /**
         * Set the value of f_nacimiento
         *
         * @return  self
         */ 
        public function setF_nacimiento($f_nacimiento)
        {
                $this->f_nacimiento = $f_nacimiento;

                return $this;
        }

        /**
         * Get the value of curso
         */ 
        public function getCurso()
        {
                return $this->curso;
        }

        /**
         * Set the value of curso
         *
         * @return  self
         */ 
        public function setCurso($curso)
        {
                $this->curso = $curso;

                return $this;
        }

        /**
         * Get the value of asignaturas
         */ 
        public function getAsignaturas()
        {
                return $this->asignaturas;
        }

        /**
         * Set the value of asignaturas
         *
         * @return  self
         */ 
        public function setAsignaturas($asignaturas)
        {
                $this->asignaturas = $asignaturas;

                return $this;
        }
    }



?>
