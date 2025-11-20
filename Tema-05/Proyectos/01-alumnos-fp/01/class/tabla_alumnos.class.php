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

                echo 'ERROR DE BASE DE DATOS' . '<br>';
                echo 'Mensaje: ' . $e->getMessage() . '<br>';
                echo 'Código de error: ' . $e->getCode() . '<br>';
                echo 'Fichero: ' . $e->getFile() . '<br>';
                echo 'Línea: ' . $e->getLine() . '<br>';

                // Paro la ejecución
                exit();

            }
            
        }
    }


?>