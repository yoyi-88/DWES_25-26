<?php
    /*
        Clase Tabla_articulos array de objetos de la clase articulo
    */

    class Class_tabla_alumnos {
        private $alumnos;

        public function __construct() {
            $this->alumnos = [];
        }

        public function get_alumnos() {
            return $this->alumnos;
        }
        
        /**
         * Set the value of articulos
         *
         * @return  self
         */ 
        public function setAlumnos($alumnos)
        {
                $this->alumnos = $alumnos;

                return $this;
        }

        


        static public function get_curso() {
            return ["1SMR", "2SMR", "1DAW", "2DAW", "1AD", "2AD"];
        }

        static public function get_Asignaturas() {
            return ["DWES", "DIWEB", "Proyecto", "DWECL", "Inglés Profesional", "DAH", "IPE II", "Redes"];
        }

        public function get_datos() {
            // creamos algunos artículos de ejemplo (la categoria y marca deben estar en los arrays estáticos y ponerse mediante sus numeros índices, además un artículo puede pertenecer a varias categorías)
            // Alumno 1: Juan Pérez García (1DAW [índice 2]), Asignaturas: DWES [0], DIWEB [1]
        $alumno = new Class_alumno(
            1, 
            "Juan", 
            "Pérez García", 
            "juan.perez@email.com", 
            "2000-01-15", 
            2, // Corresponde a "1DAW"
            [0, 1] // Corresponde a ["DWES", "DIWEB"]
        );
        $this->alumnos[] = $alumno;

        // Alumno 2: Ana López Martín (2DAW [índice 3]), Asignaturas: DWES [0], Proyecto [2], Inglés Profesional [4]
        $alumno = new Class_alumno(
            2, 
            "Ana", 
            "López Martín", 
            "ana.lopez@email.com", 
            "2001-03-20", 
            3, // Corresponde a "2DAW"
            [0, 2, 4] // Corresponde a ["DWES", "Proyecto", "Inglés Profesional"]
        );
        $this->alumnos[] = $alumno;

        // Alumno 3: Carlos Ruiz Sánchez (1SMR [índice 0]), Asignaturas: DAH [5], IPE II [6]
        $alumno = new Class_alumno(
            3, 
            "Carlos", 
            "Ruiz Sánchez", 
            "carlos.ruiz@email.com", 
            "1999-11-05", 
            0, // Corresponde a "1SMR"
            [5, 6] // Corresponde a ["DAH", "IPE II"]
        );
        $this->alumnos[] = $alumno;

        // Alumno 4: Elena Gómez Flores (1AD [índice 4]), Asignaturas: DIWEB [1], DWECL [3]
        $alumno = new Class_alumno(
            4, 
            "Elena", 
            "Gómez Flores", 
            "elena.gomez@email.com", 
            "2002-07-10", 
            4, // Corresponde a "1AD"
            [1, 3] // Corresponde a ["DIWEB", "DWECL"]
        );
        $this->alumnos[] = $alumno;

        // Alumno 5: Miguel Hernández Gil (2AD [índice 5]), Asignaturas: Proyecto [2], Redes [7]
        $alumno = new Class_alumno(
            5, 
            "Miguel", 
            "Hernández Gil", 
            "miguel.hernandez@email.com", 
            "2000-05-25", 
            5, // Corresponde a "2AD"
            [2, 7] // Corresponde a ["Proyecto", "Redes"]
        );
        $this->alumnos[] = $alumno;

            
            
        }
        // 
        
        /*
        Convertir array de indices de categorías a sus nombres de categorías
        Parámetros:
            - $indices: array de índices de categorías
        */ 
        static public function asignaturas_indices_a_nombres($indices) {
            $todas_asignaturas = self::get_Asignaturas();

            // array donde guardaremos los nombres de las categorías
            $nombres_asignaturas = [];

            foreach ($indices as $indice) {
                
                $nombres_asignaturas[] = $todas_asignaturas[$indice];
                
            }
            return $nombres_asignaturas;
        }

        /**
         * Método: get_next_id()
         * Descripción: Obtiene el siguiente ID disponible (max ID + 1)
         * Retorno: int - El siguiente ID
         */
        public function get_next_id() {
            $max_id = 0;
            
            // Si el array está vacío después de cargar los datos, el primer ID es 1.
            if (empty($this->alumnos)) {
                return 1;
            }

            // Recorre el array para encontrar el ID más alto
            foreach ($this->alumnos as $alumno) {
                if ($alumno->getId() > $max_id) {
                    $max_id = $alumno->getId();
                }
            }
            // Devuelve el máximo ID encontrado más 1
            return $max_id + 1;
        }

        /*Método: create()
        Añade un nuevo artículo
        Parámetros: objeto de la clase artículo  */

        public function create(Class_alumno $alumno) {
            $this->alumnos[] = $alumno;
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
            foreach($this->alumnos as $indice => $alumno) {
                if ($alumno->getId() == $id) {
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
        public function get_alumno_from_indice($indice) {
            return $this->alumnos[$indice];
        }

        /*
            método: update()
            descripción: actualiza los detalles de un artículo en la tabla a partir del id de dicho artículo

            Parámetro:
            - Objeto de la clase artículo, co los detalles del artículo
            -indice del array en el que se encuentra dicho artículo
        */
        public function update(Class_alumno $alumno, $indice) {
            // 
            $this->alumnos[$indice] = $alumno;

        }

        /*
            método: delete()
            descripción: elimino el artículo del array a partir del índice en el que se encuentra

            parámetros:
            -índice: indice del array en el que se encuent
        */

        public function delete($indice) {
            unset($this->alumnos[$indice]);
            array_values($this->alumnos);
        }

        
    }



    

?>