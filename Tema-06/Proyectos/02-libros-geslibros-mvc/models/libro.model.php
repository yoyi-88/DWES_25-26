<?php
/*
    Modelo:  libroModel
    Descripción: Modelo para gestionar los datos de los libros
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
    Indices: id => titulo
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
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // Ejecutar la consulta
            $stmt->execute();

            // **CAMBIO CLAVE 2:** Obtener todos los resultados y devolverlos
            $editoriales = $stmt->fetchAll();
            return $editoriales;
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
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // Ejecutar la consulta
            $stmt->execute();

            $autores = $stmt->fetchAll();

            return $autores;
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
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // Ejecutar la consulta
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {

            // Manejo del error
           $this->handleError($e);
        }
    }

    /*
    Método: get_temas_libro(int $id)
    Descripción: Obtiene un array con los IDs de los temas de un libro específico
    */
    public function get_temas_libro(int $id) {
        try {
            $sql = "SELECT tema_id FROM libros_temas WHERE libro_id = :id";
            
            $geslibros = $this->db->connect();
            $stmt = $geslibros->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Devolvemos un array simple de los IDs de los temas
            return $stmt->fetchAll(PDO::FETCH_COLUMN);

        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }


    /*
        Método: create($libro)
        Descripción: Inserta un nuevo libro en la base de datos ges$geslibros
        Parámetros: 
            - $libro: objeto de la clase class_libro con los datos del libro a insertar
        Devuelve:
            - id del nuevo libro insertado
            - falso en caso de error
    */
    public function create($libro) {

        try {
        // Consulta SQL para insertar un nuevo libro
        $sql = "INSERT INTO libros 
                (titulo, autor_id, editorial_id, generos, stock, precio_venta, fecha_nac, curso_id) 
                VALUES 
                (:titulo, :autor_id, :editorial_id, :generos, :stock, :precio_venta, :fecha_nac, :curso_id)";

        // Conectar con la base de datos
        $geslibros = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $geslibros->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 30);
        $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_STR, 50);
        $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_STR, 50);
        $stmt->bindParam(':generos', $libro->generos, PDO::PARAM_STR, 9);
        $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_STR, 9);
        $stmt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_STR, 30);
        $stmt->bindParam(':fecha_nac', $libro->fecha_nac, PDO::PARAM_STR, 10);
        $stmt->bindParam(':curso_id', $libro->curso_id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Devuelvo el id del nuevo libro insertado
        return $geslibros->lastInsertId();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: read()
        Descripción: obtiene los detalles de un libro devolviendo un objeto de la clase  class_libro
        Paráemtros: 
            - $id: id del libro

        Devuelve:
            - $libro: objeto de la clase class_libro
    */
    public function read(int $id){
        try {

            $sql = "SELECT 
                    id, titulo, autor_id, editorial_id, null, stock, precio_venta
                    FROM libros WHERE id = :id
                    ";
            
            // conectamos con la base de datos
            $geslibros = $this->db->connect();

            // prepare
            $stmt = $geslibros->prepare($sql);

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
        Descripción: obtiene los detalles de un libro devolviendo un objeto con los detalles del libro
        incluido el titulo del curso
        Paráemtros: 
            - $id: id del libro

        Devuelve:
            - $libro: objeto de la clase libro con los detalles del libro
    */
    public function read_show(int $id){
        try {

            $sql = "SELECT 
                    libros.id, libros.titulo, autor_id, editorial_id, stock, precio_venta, generos, fecha_nac, curso_id, cursos.titulo AS curso
                    FROM libros INNER JOIN cursos
                    ON libros.curso_id = cursos.id WHERE libros.id = :id
                    LIMIT 1
                    ";
            
            // conectamos con la base de datos
            $geslibros = $this->db->connect();

            // prepare
            $stmt = $geslibros->prepare($sql);

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
        Método: update($libro)
        Descripción: Actualiza los datos de un libro en la base de datos ges$geslibros
        Parámetros: 
            - $libro: objeto de la clase class_libro con los datos del libro a actualizar
            - $id: id del libro a actualizar
        Devuelve:
            - true si la actualización fue exitosa
            - false en caso de error
    */
    public function update($libro) {

        try {
        // Consulta SQL para actualizar un libro
        $sql = "UPDATE libros SET 
                    titulo = :titulo, 
                    autor_id = :autor_id, 
                    editorial_id = :editorial_id, 
                    stock = :stock, 
                    precio_venta = :precio_venta
                WHERE id = :id";

        // Conectar con la base de datos
        $geslibros = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $geslibros->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 30);
        $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_STR, 50);
        $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_STR, 50);
        $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
        $stmt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_INT);
        $stmt->bindParam(':id', $libro->id, PDO::PARAM_INT);

        // Ejecutar la consulta
        return $stmt->execute();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: delete($id)
        Descripción: Elimina un libro de la base de datos ges$geslibros
        Parámetros: 
            - $id: id del libro a eliminar
        Devuelve:
            - true si la eliminación fue exitosa
            - false en caso de error
    */
    public function delete(int $id) {
        try {
        // Consulta SQL para eliminar un libro
        $sql = "DELETE FROM libros WHERE id = :id LIMIT 1";

        // Conectar con la base de datos
        $geslibros = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $geslibros->prepare($sql);

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
        Descripción: Busca libros en la base de datos ges$geslibros que coincidan con el término de búsqueda
        Parámetros: 
            - $term: término de búsqueda
        Devuelve:
            - objeto PDOStatement con los resultados de la búsqueda
    */
    public function search(string $term) {

        try {
        // Consulta SQL para buscar libros
        $sql = "SELECT 
                    libros.id,
                    concat_ws(', ', libros.autor_id, libros.titulo) as libro,
                    libros.editorial_id,
                    libros.precio_venta,
                    libros.generos,
                    timestampdiff(YEAR,  libros.fecha_nac, now()) as edad,
                    cursos.tituloCorto as curso
                FROM libros INNER JOIN cursos
                ON libros.curso_id = cursos.id
                WHERE concat_ws(' ',
                    libros.titulo,  
                    libros.autor_id,  
                    libros.editorial_id,
                    libros.precio_venta, 
                    libros.generos,
                    libros.fecha_nac,
                    timestampdiff(YEAR,  libros.fecha_nac, now()),
                    cursos.tituloCorto,
                    cursos.titulo
                    ) LIKE :term
                ORDER BY 1
                ";

        // Conectar con la base de datos
        $geslibros = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $geslibros->prepare($sql);

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
        Descripción: Ordena la lista de libros por un criterio
        Parámetros:
            - $criterio: campo por el que se ordena la lista
                1: id
                2: titulo
                3: editorial_id
                4: precio_venta
                5: generos
                6: edad
                7: curso
        Devuelve:
            - objeto PDOStatement con los resultados ordenados
    */
    public function order(int $criterio) {

        try {

        // Consulta SQL para ordenar libros
        $sql = "SELECT 
                    libros.id,
                    concat_ws(', ', libros.autor_id, libros.titulo) as libro,
                    libros.editorial_id,
                    libros.precio_venta,
                    libros.generos,
                    timestampdiff(YEAR,  libros.fecha_nac, now()) as edad,
                    cursos.tituloCorto as curso
                FROM libros INNER JOIN cursos
                ON libros.curso_id = cursos.id
                ORDER BY :criterio";

        // Conectar con la base de datos
        $geslibros = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $geslibros->prepare($sql);

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