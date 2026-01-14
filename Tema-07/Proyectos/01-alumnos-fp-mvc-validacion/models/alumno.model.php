<?php
/*
    Modelo:  alumnoModel
    Descripción: Modelo para gestionar los datos de los alumnos
*/
   

class alumnoModel extends Model {

    
    /*
        Método: get()
        Descripción: Obtiene todos los alumnos de la base de datos fp
    */

    public function get() {

        try {
        // Consulta SQL para obtener todos los alumnos
        $sql = "
            select 
                    alumnos.id,
                    concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                    alumnos.email,
                    alumnos.nacionalidad,
                    alumnos.dni,
                    timestampdiff(YEAR,  alumnos.fecha_nac, now()) as edad,
                    cursos.nombreCorto as curso
            FROM alumnos LEFT JOIN cursos
            ON alumnos.curso_id = cursos.id
            ORDER BY 1
        ";

        // Conectar con la base de datos
        $fp = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $fp->prepare($sql);

        // Establecer modo de obtención de datos  fectch
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Ejecutar la consulta
        $stmt->execute();
        
        // Devuelvo objeto de la clase PDOStatement o array con los datos
        return $stmt->fetchAll();

        } catch (PDOException $e) {

            // Manejo del error
           $this->handleError($e); 
          
        }
    }

    /*
        Método: get_cursos()
        Descripción: Obtiene todos los cursos de la base de datos fp
    */
    public function get_cursos() {

        try {
        // Consulta SQL para obtener todos los cursos
        $sql = "SELECT id, nombreCorto as curso FROM cursos ORDER BY 2";

        // Conectar con la base de datos
        $fp = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $fp->prepare($sql);

         // Establecer modo de obtención de datos  fectch
        $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

        // Ejecutar la consulta
        $stmt->execute();

        // obtengo un array asociativo con los resultados
        $cursos = $stmt->fetchAll();
        
        // Devuelvo objeto de la clase PDOStatement o array con los datos
        return $cursos;

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: create()
        Descripción: Crea un nuevo alumno en la base de datos fp
        Parámetros: class_alumno $alumno - Objeto de la clase alumno con los datos del nuevo alumno
        Devuelve:
        - id del nuevo alumno insertado
        - falso en caso de error
    */

    public function create(class_alumno $alumno) {

        try {
            // Consulta SQL para insertar un nuevo alumno
            $sql = "INSERT INTO alumnos (nombre, apellidos, email, telefono, nacionalidad, dni, fecha_nac, curso_id)
                    VALUES (:nombre, :apellidos, :email, :telefono, :nacionalidad, :dni, :fecha_nac, :curso_id)";

            // Conectar con la base de datos
            $fp = $this->db->connect();

            // Preparar la consulta obteniendo el objeto PDOStatement
            $stmt = $fp->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $stmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 9);
            $stmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fecha_nac', $alumno->fecha_nac, PDO::PARAM_STR, 10);
            $stmt->bindParam(':curso_id', $alumno->curso_id, PDO::PARAM_INT);

            $stmt->execute();

            return $fp->lastInsertId();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: read()
        Descripción obtiene los detalles de un alumno devolviendo un objeto de la clase class_alumno
        Parámetros:
            - $id: id del alumnno
        Devuelve: 
            - $alumno: objetop de la clase class_alumno
    */
    public function read(int $id) {
        try {
            $sql = "SELECT
                    id, nombre, apellidos, email, telefono, nacionalidad, dni, fecha_nac, curso_id
                    FROM alumnos WHERE id = :id
            ";

            // conectamos con la base de datos
            $fp = $this->db->connect();

            // prepare
            $stmt = $fp->prepare($sql);

            // Vincular los parámetros del prepare
            $stmt->bindParam(':id', $id, PDO:: PARAM_INT);

            // Establecemos tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecutamos
            $stmt->execute();

            // Devolvemos el primer y único valor del stmt
            return $stmt->fetch();

        } catch (PDOException $e) {
            // Manejo del error
            $this->handleError($e);
        }
    }

    /*
        Método: update()
        Descripción: Actualiza los datos de un alumno en la base de datos fp
        Parámetros: 
            - $id: id del alumno a actualizar
            - class_alumno $alumno: objeto de la clase class_alumno con los datos actualizados
    */
    public function update(int $id, class_alumno $alumno) {

        try {
            // Consulta SQL para actualizar un alumno
            $sql = "UPDATE alumnos 
                    SET nombre = :nombre,
                        apellidos = :apellidos,
                        email = :email,
                        telefono = :telefono,
                        nacionalidad = :nacionalidad,
                        dni = :dni,
                        fecha_nac = :fecha_nac,
                        curso_id = :curso_id
                    WHERE id = :id
            ";

            // Conectar con la base de datos
            $fp = $this->db->connect();

            // Preparar la consulta obteniendo el objeto PDOStatement
            $stmt = $fp->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $stmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 9);
            $stmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fecha_nac', $alumno->fecha_nac, PDO::PARAM_STR, 10);
            $stmt->bindParam(':curso_id', $alumno->curso_id, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: delete()
        Descripción: Elimina un alumno de la base de datos fp
        Parámetros:
            - $id: id del alumno a eliminar
    */

    public function delete(int $id) {

        try {
            // Consulta SQL para eliminar un alumno
            $sql = "DELETE FROM alumnos WHERE id = :id";

            // Conectar con la base de datos
            $fp = $this->db->connect();

            // Preparar la consulta obteniendo el objeto PDOStatement
            $stmt = $fp->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: orderBy
        Descripción: Obtiene todos los alumnos ordenados por un campo específico
    */    
    // public function orderBy($campo) {

    //     try {
    //     // Consulta SQL para obtener todos los alumnos ordenados por un campo específico
    //     $sql = "SELECT 
    //                 alumnos.id,
    //                 concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
    //                 alumnos.email,
    //                 alumnos.nacionalidad,
    //                 alumnos.dni,
    //                 timestampdiff(YEAR,  alumnos.fecha_nac, now()) as edad,
    //                 cursos.nombreCorto as curso
    //         FROM alumnos LEFT JOIN cursos
    //         ON alumnos.curso_id = cursos.id 
    //         ORDER BY `" . $campo . "`";

    //     // Conectar con la base de datos
    //     $fp = $this->db->connect();

    //     // Preparar la consulta obteniendo el objeto PDOStatement
    //     $stmt = $fp->prepare($sql);

    //     // Establecer modo de obtención de datos  fectch
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);

    //     // Ejecutar la consulta
    //     $stmt->execute();
        
    //     // Devuelvo objeto de la clase PDOStatement o array con los datos
    //     return $stmt->fetchAll();

    //     } catch (PDOException $e) {

    //         // Manejo del error
    //        $this->handleError($e); 
          
    //     }
    // }



    

    /*
        Método: handleError
        Descripción: Maneja los errores de la base de datos
        Parámetros: PDOException $e - La excepción lanzada
    */

    private function handleError(PDOException $e)
    {
        // Incluir y cargar el controlador de errores
        $errorControllerFile = CONTROLLER_PATH . ERROR_CONTROLLER . '.php';
        
        if (file_exists($errorControllerFile)) {
            require_once $errorControllerFile;
            $mensaje = $e->getMessage() . " en la línea " . $e->getLine() . " del archivo " . $e->getFile();
            $controller = new Errores('DE BASE DE DATOS', 'Mensaje de Error: ', $mensaje);
            
        } else {
            // Fallback en caso de que el controlador de errores no exista
            echo "Error crítico: " . $e->getMessage();
            exit();
        }
    }

    /*
        Método: validate_unique_email($email)
        Descripción: valida email único en la table alumnos 
        Parámeterros:
            - $email
        Devuelve:
            - Falso - email existe
            - Verdadero - email único
    */
    public function validate_unique_email($email) {
        try {
            // Gemeramos select
            $sql = 'SELECT email FROM alumnos WHERE email = :email';

            // Conectar con la base de datos
            $fp = $this->db->connect();

            // Preparar la consulta obteniendo el objeto PDOStatement
            $stmt = $fp->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);

            // Ejecutamos sql
            $stmt->execute();

            // Validamos
            if ($stmt->rowCount() > 0) {
                return FALSE;
            }

            return TRUE;

        } catch(PDOException $e) {
            // Manejo del error
            $this->handleError($e);
        }
    }

   }

?>