<?php
/*
    Modelo:  alumnoModel
    Descripción: Modelo para gestionar los datos de los alumnos
*/
   

class libroModel extends Model {

    
    /*
        Método: get()
        Descripción: Obtiene todos los libros de la base de datos geslibros
    */

    public function get() {

        try {
        // Consulta SQL para obtener todos los libros
        $sql = "
            SELECT 
                l.id,
                l.titulo,
                a.nombre AS autor,
                e.nombre AS editorial,
                GROUP_CONCAT(t.tema ORDER BY t.tema SEPARATOR ', ') AS generos,
                l.stock,
                l.precio_venta precio 
            FROM libros AS l
            LEFT JOIN autores AS a         ON l.autor_id = a.id
            LEFT JOIN editoriales AS e     ON l.editorial_id = e.id
            LEFT JOIN libros_temas AS lt   ON l.id = lt.libro_id
            LEFT JOIN temas AS t           ON lt.tema_id = t.id
            GROUP BY l.id
            ORDER BY l.id ASC
        ";

        // Conectar con la base de datos
        $geslibros = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $geslibros->prepare($sql);

        // Establecer modo de obtención de datos  fectch
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Ejecutar la consulta
        $stmt->execute();
        
        // Devuelvo objeto de la clase PDOStatement o array con los datos
        return $stmt;

        } catch (PDOException $e) {

            // Manejo del error
           $this->handleError($e); 
          
        }
    }

    /*
    método:  get_editoriales()
    descripción: obtiene un array acociativo con las editoriales de la base de datos
    Indices: id => nombre
    */

    public function get_editoriales()
    {
        try {

            $sql = "SELECT id, nombre FROM editoriales ORDER BY nombre ASC";

            // Conectar con la base de datos
            $geslibros = $this->db->connect();

            // Preparar la consulta obteniendo el objeto PDOStatement
            $stmt = $geslibros->prepare($sql);

            // Establecer modo de obtención de datos  fectch
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // Ejecutar la consulta
            $stmt->execute();
           
        } catch (PDOException $e) {

            // Manejo del error
           $this->handleError($e); 
        }
        
    }

     /*
    método:  get_autories()
    descripción: obtiene un array acociativo con los autores de la base de datos
    */
    
    public function get_autores() {
        try {

            $sql = "SELECT id, nombre FROM autores ORDER BY nombre ASC";

            // Conectar con la base de datos
            $geslibros = $this->db->connect();

            // Preparar la consulta obteniendo el objeto PDOStatement
            $stmt = $geslibros->prepare($sql);

            // Establecer modo de obtención de datos  fectch
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // Ejecutar la consulta
            $stmt->execute();
        } catch (PDOException $e) {

            // Manejo del error
           $this->handleError($e);
        }
    }

    public function get_generos() {
        try {

            $sql = "SELECT id, tema FROM temas ORDER BY tema ASC";

            // Conectar con la base de datos
            $geslibros = $this->db->connect();

            // Preparar la consulta obteniendo el objeto PDOStatement
            $stmt = $geslibros->prepare($sql);

            // Establecer modo de obtención de datos  fectch
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // Ejecutar la consulta
            $stmt->execute();
        } catch (PDOException $e) {

            // Manejo del error
           $this->handleError($e);
        }
    }


    /*
        Método: create($alumno)
        Descripción: Inserta un nuevo alumno en la base de datos fp
        Parámetros: 
            - $alumno: objeto de la clase class_alumno con los datos del alumno a insertar
        Devuelve:
            - id del nuevo alumno insertado
            - falso en caso de error
    */
    public function create($alumno) {

        try {
        // Consulta SQL para insertar un nuevo alumno
        $sql = "INSERT INTO alumnos 
                (nombre, apellidos, email, dni, telefono, nacionalidad, fecha_nac, curso_id) 
                VALUES 
                (:nombre, :apellidos, :email, :dni, :telefono, :nacionalidad, :fecha_nac, :curso_id)";

        // Conectar con la base de datos
        $fp = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $fp->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
        $stmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
        $stmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
        $stmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
        $stmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 9);
        $stmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
        $stmt->bindParam(':fecha_nac', $alumno->fecha_nac, PDO::PARAM_STR, 10);
        $stmt->bindParam(':curso_id', $alumno->curso_id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Devuelvo el id del nuevo alumno insertado
        return $fp->lastInsertId();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: read()
        Descripción: obtiene los detalles de un alumno devolviendo un objeto de la clase  class_alumno
        Paráemtros: 
            - $id: id del alumno

        Devuelve:
            - $alumno: objeto de la clase class_alumno
    */
    public function read(int $id){
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
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // establecemos tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejectuamos
            $stmt->execute();

            // Devolvemos el primer y único valor del stmt
            return $stmt->fetch();

        }
         catch (PDOException $e){
            // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: read_show()
        Descripción: obtiene los detalles de un alumno devolviendo un objeto con los detalles del alumno
        incluido el nombre del curso
        Paráemtros: 
            - $id: id del alumno

        Devuelve:
            - $alumno: objeto de la clase alumno con los detalles del alumno
    */
    public function read_show(int $id){
        try {

            $sql = "SELECT 
                    alumnos.id, alumnos.nombre, apellidos, email, telefono, nacionalidad, dni, fecha_nac, curso_id, cursos.nombre AS curso
                    FROM alumnos INNER JOIN cursos
                    ON alumnos.curso_id = cursos.id WHERE alumnos.id = :id
                    LIMIT 1
                    ";
            
            // conectamos con la base de datos
            $fp = $this->db->connect();

            // prepare
            $stmt = $fp->prepare($sql);

            // Vincular los parámetros del prepare
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // establecemos tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejectuamos
            $stmt->execute();

            // Devolvemos el primer y único valor del stmt
            return $stmt->fetch();

        }
         catch (PDOException $e){
            // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: update($alumno)
        Descripción: Actualiza los datos de un alumno en la base de datos fp
        Parámetros: 
            - $alumno: objeto de la clase class_alumno con los datos del alumno a actualizar
            - $id: id del alumno a actualizar
        Devuelve:
            - true si la actualización fue exitosa
            - false en caso de error
    */
    public function update($alumno) {

        try {
        // Consulta SQL para actualizar un alumno
        $sql = "UPDATE alumnos SET 
                    nombre = :nombre, 
                    apellidos = :apellidos, 
                    email = :email, 
                    dni = :dni, 
                    telefono = :telefono, 
                    nacionalidad = :nacionalidad, 
                    fecha_nac = :fecha_nac, 
                    curso_id = :curso_id
                WHERE id = :id";

        // Conectar con la base de datos
        $fp = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $fp->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
        $stmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
        $stmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
        $stmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
        $stmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 9);
        $stmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
        $stmt->bindParam(':fecha_nac', $alumno->fecha_nac, PDO::PARAM_STR, 10);
        $stmt->bindParam(':curso_id', $alumno->curso_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $alumno->id, PDO::PARAM_INT);

        // Ejecutar la consulta
        return $stmt->execute();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: delete($id)
        Descripción: Elimina un alumno de la base de datos fp
        Parámetros: 
            - $id: id del alumno a eliminar
        Devuelve:
            - true si la eliminación fue exitosa
            - false en caso de error
    */
    public function delete(int $id) {
        try {
        // Consulta SQL para eliminar un alumno
        $sql = "DELETE FROM alumnos WHERE id = :id LIMIT 1";

        // Conectar con la base de datos
        $fp = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $fp->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar la consulta
        return $stmt->execute();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: search($term)
        Descripción: Busca alumnos en la base de datos fp que coincidan con el término de búsqueda
        Parámetros: 
            - $term: término de búsqueda
        Devuelve:
            - objeto PDOStatement con los resultados de la búsqueda
    */
    public function search(string $term) {

        try {
        // Consulta SQL para buscar alumnos
        $sql = "SELECT 
                    alumnos.id,
                    concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                    alumnos.email,
                    alumnos.nacionalidad,
                    alumnos.dni,
                    timestampdiff(YEAR,  alumnos.fecha_nac, now()) as edad,
                    cursos.nombreCorto as curso
                FROM alumnos INNER JOIN cursos
                ON alumnos.curso_id = cursos.id
                WHERE concat_ws(' ',
                    alumnos.nombre,  
                    alumnos.apellidos,  
                    alumnos.email,
                    alumnos.nacionalidad, 
                    alumnos.dni,
                    alumnos.fecha_nac,
                    timestampdiff(YEAR,  alumnos.fecha_nac, now()),
                    cursos.nombreCorto,
                    cursos.nombre
                    ) LIKE :term
                ORDER BY 1
                ";

        // Conectar con la base de datos
        $fp = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $fp->prepare($sql);

        // Vincular los parámetros
        $likeTerm = '%' . $term . '%';
        $stmt->bindParam(':term', $likeTerm, PDO::PARAM_STR);

        // Establecer modo de obtención de datos  fectch
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Ejecutar la consulta
        $stmt->execute();
        
        // Devuelvo objeto de la clase PDOStatement o array con los datos
        return $stmt;

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: order($criterio)
        Descripción: Ordena la lista de alumnos por un criterio
        Parámetros:
            - $criterio: campo por el que se ordena la lista
                1: id
                2: nombre
                3: email
                4: nacionalidad
                5: dni
                6: edad
                7: curso
        Devuelve:
            - objeto PDOStatement con los resultados ordenados
    */
    public function order(int $criterio) {

        try {

        // Consulta SQL para ordenar alumnos
        $sql = "SELECT 
                    alumnos.id,
                    concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                    alumnos.email,
                    alumnos.nacionalidad,
                    alumnos.dni,
                    timestampdiff(YEAR,  alumnos.fecha_nac, now()) as edad,
                    cursos.nombreCorto as curso
                FROM alumnos INNER JOIN cursos
                ON alumnos.curso_id = cursos.id
                ORDER BY :criterio";

        // Conectar con la base de datos
        $fp = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $fp->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

        // Establecer modo de obtención de datos  fectch
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Ejecutar la consulta
        $stmt->execute();
        
        // Devuelvo objeto de la clase PDOStatement o array con los datos
        return $stmt;

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }


    /*
        Método: handleError
        Descripción: Maneja los errores de la base de datos
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

   }

?>