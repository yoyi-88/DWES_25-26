<?php
    /*
        clase: clase_tabla_alumnos
        descripción: define la clase que va a permitir realizar CRUD alumnos:
            - index
            - añadir
            - actualizar
            - eliminar
            - buscar
            - ordenar
        herencia: clase padre class_conexion
    */

    class class_tabla_alumnos extends class_conexion {
        /*
            método: get_alumnos()
            descripcion: extrae los alumnos de la tabla alumnos
            parámetros: no tiene
            devuelve: objetop de la clase mysqli_result
        */

        public function get_alumnos() {

            try {

                $sql = "
                
                    select
                        alumnos.id,
                        concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                        alumnos.email,
                        alumnos.nacionalidad,
                        alumnos.dni,
                        timestampdiff(YEAR, alumnos.fecha_nac, now()) as edad,
                        cursos.nombreCorto as curso
                    FROM alumnos INNER JOIN cursos
                    ON alumnos.curso_id = cursos.id
                    ORDER BY 1
                ";

                // Prepare 
                // Crear un objeto de la clase mysqli_stmt
                $stmt = $this->mysqli->prepare($sql);

                // No necesita vincular parámetros, ya que no los tengo definidos
                // Ejecuto el comando
                $stmt->execute();

                // devuelve un objeto de la clase mysqli_result con los detalles de los alumnos
                return $stmt->get_result();

            }catch(mysqli_sql_exception $e) {

                include 'views/partials/errorDB.partial.php';

                // Paro la ejecución
                exit();

            }
            
        }

        /*
            método: get_cursos()
            descripcion: extrae todos los cursos de la base de datos fp
            parámetros:
            devuelve: un array asociativo con los cursos con id y nombreCorto
        */
        public function get_cursos() {

            try {

                $sql = "
                
                    select
                        id,
                        nombreCorto as curso
                    FROM cursos
                    ORDER BY 2
                ";

                // Prepare 
                // Crear un objeto de la clase mysqli_stmt
                $stmt = $this->mysqli->prepare($sql);

                // No necesita vincular parámetros, ya que no los tengo definidos
                // Ejecuto el comando
                $stmt->execute();

                // devuelve un objeto de la clase mysqli_result con los detalles de los alumnos
                $cursos = $stmt->get_result();

                // Paso el resultado a un array asociativo
                return $cursos->fetch_all(MYSQLI_ASSOC);

            }catch(mysqli_sql_exception $e) {

                include 'views/partials/errorDB.partial.php';

                // Paro la ejecución
                exit();

            }
            
        }

        public function insertar_alumno() {

            try {

                $sql = "
                
                    INSERT INTO alumnos (id, nombre, apellidos, email, telefono, direccion, poblacion, provincia, nacionalidad, dni, fecha_nac, curso_id)
                    VALUES (null, will, smith, nose@gmail.com, 236585854, null, null, null, español, 45454545b, 2/2/2008, 3);
                ";

                // Prepare 
                // Crear un objeto de la clase mysqli_stmt
                $stmt = $this->mysqli->prepare($sql);

                // No necesita vincular parámetros, ya que no los tengo definidos
                // Ejecuto el comando
                $stmt->execute();

                // devuelve un objeto de la clase mysqli_result con los detalles de los alumnos
                $cursos = $stmt->get_result();

                // Paso el resultado a un array asociativo
                return $cursos->fetch_all(MYSQLI_ASSOC);

            }catch(mysqli_sql_exception $e) {

                include 'views/partials/errorDB.partial.php';

                // Paro la ejecución
                exit();

            }
            
        }
    }


?>