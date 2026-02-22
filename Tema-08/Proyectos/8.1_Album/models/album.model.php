<?php
/*
    Modelo:  albumModel
    Descripción: Modelo para gestionar los datos de los albumes
*/
   

class AlbumModel extends Model {

    
    /*
        Método: get()
        Descripción: Obtiene todos los albumes de la base de datos bdAlbum
    */

    public function get() {

        try {
        // Consulta SQL para obtener todos los albumes
        $sql = "
            SELECT id, titulo, autor, fecha, etiquetas, num_fotos, num_visitas
            FROM albumes ORDER BY 1;
        ";

        // Conectar con la base de datos
        $bdAlbum = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $bdAlbum->prepare($sql);

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
        Método: get_cursos()
        Descripción: Obtiene todos los cursos de la base de datos bdAlbum
    */
    public function get_cursos() {

        try {
        // Consulta SQL para obtener todos los cursos
        $sql = "SELECT id, tituloCorto as curso FROM cursos ORDER BY 2";

        // Conectar con la base de datos
        $bdAlbum = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $bdAlbum->prepare($sql);

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
        Método: create($album)
        Descripción: Inserta un nuevo album en la base de datos bdAlbum
        Parámetros: 
            - $album: objeto de la clase class_album con los datos del album a insertar
        Devuelve:
            - id del nuevo album insertado
            - falso en caso de error
    */
    public function create($album) {

        try {
        // Consulta SQL para insertar un nuevo album
        $sql = "INSERT INTO albumes 
                (titulo, descripcion, autor, fecha, etiquetas, carpeta)
                VALUES
                (:titulo, :descripcion, :autor, :fecha, :etiquetas, :carpeta)";

        // Conectar con la base de datos
        $bdAlbum = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $bdAlbum->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
        $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
        $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR, 10);
        $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 250);
        $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 50);


        // Ejecutar la consulta
        $stmt->execute();

        // Devuelvo el id del nuevo album insertado
        return $bdAlbum->lastInsertId();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: read()
        Descripción: obtiene los detalles de un album devolviendo un objeto de la clase  class_album
        Paráemtros: 
            - $id: id del album

        Devuelve:
            - $album: objeto de la clase class_album
    */
    public function read(int $id){
        try {

            $sql = "SELECT 
                    id, titulo, descripcion, autor, fecha, etiquetas, num_fotos, num_visitas, carpeta
                    FROM albumes WHERE id = :id
                    ";
            
            // conectamos con la base de datos
            $bdAlbum = $this->db->connect();

            // prepare
            $stmt = $bdAlbum->prepare($sql);

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
        Descripción: obtiene los detalles de un album devolviendo un objeto con los detalles del album
        incluido el titulo del curso
        Paráemtros: 
            - $id: id del album

        Devuelve:
            - $album: objeto de la clase album con los detalles del album
    */
    public function read_show(int $id){
        try {

            $sql = "SELECT 
                    albumes.id, albumes.titulo, albumes.descripcion, albumes.autor, albumes.fecha, albumes.etiquetas, albumes.num_fotos, albumes.num_visitas, albumes.carpeta
                    FROM albumes WHERE albumes.id = :id
                    LIMIT 1
                    ";
            
            // conectamos con la base de datos
            $bdAlbum = $this->db->connect();

            // prepare
            $stmt = $bdAlbum->prepare($sql);

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
        Método: update($album)
        Descripción: Actualiza los datos de un album en la base de datos bdAlbum
        Parámetros: 
            - $album: objeto de la clase class_album con los datos del album a actualizar
            - $id: id del album a actualizar
        Devuelve:
            - true si la actualización fue exitosa
            - false en caso de error
    */
    public function update($album) {

        try {
        // Consulta SQL para actualizar un album
        $sql = "UPDATE albumes SET 
                    titulo = :titulo,
                    descripcion = :descripcion,
                    autor = :autor,
                    fecha = :fecha,
                    etiquetas = :etiquetas
                WHERE id = :id";

        // Conectar con la base de datos
        $bdAlbum = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $bdAlbum->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':id', $album->id, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 30);
        $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 255);
        $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
        $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR, 10);
        $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 255);

        // Ejecutar la consulta
        return $stmt->execute();

        } catch (PDOException $e) {

           // Manejo del error
           $this->handleError($e); 
        }
    }

    /*
        Método: delete($id)
        Descripción: Elimina un album de la base de datos bdAlbum
        Parámetros: 
            - $id: id del album a eliminar
        Devuelve:
            - true si la eliminación fue exitosa
            - false en caso de error
    */
    public function delete(int $id) {
        try {
        // Consulta SQL para eliminar un album
        $sql = "DELETE FROM albumes WHERE id = :id LIMIT 1";

        // Conectar con la base de datos
        $bdAlbum = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $bdAlbum->prepare($sql);

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
        Descripción: Busca albumes en la base de datos bdAlbum que coincidan con el término de búsqueda
        Parámetros: 
            - $term: término de búsqueda
        Devuelve:
            - objeto PDOStatement con los resultados de la búsqueda
    */
    public function search(string $term) {

        try {
        // Consulta SQL para buscar albumes
        $sql = "SELECT 
                    id,
                    titulo,
                    autor,
                    fecha,
                    etiquetas,
                    num_fotos,
                    num_visitas
                FROM albumes 
                WHERE CONCAT_WS(' ', titulo, autor, descripcion, etiquetas) LIKE :term
                ORDER BY id ASC
                ";

        // Conectar con la base de datos
        $bdAlbum = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $bdAlbum->prepare($sql);

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
        Descripción: Ordena la lista de albumes por un criterio
        Parámetros:
            - $criterio: campo por el que se ordena la lista
                1: id
                2: titulo
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

        // Consulta SQL para ordenar albumes
        $sql = "SELECT 
                    id,
                    titulo,
                    autor,
                    fecha,
                    etiquetas,
                    num_fotos,
                    num_visitas
                FROM albumes 
                ORDER BY :criterio";

        // Conectar con la base de datos
        $bdAlbum = $this->db->connect();

        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $bdAlbum->prepare($sql);

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
        Método: validate_id_album_exists($album_id)
        Descripción: valida que el album_id exista en la tabla cursos
        Parámetros: 
            - $album_id
        Devuelve:
            - Falso - album_id no existente
            - Verdadero - album_id existente
    */
    public function validate_id_album_exists($album_id) {
        try {
        // Generamos select 
        $sql = "SELECT id FROM albumes WHERE id = :album_id";
        // Conectar con la base de datos
        $bdAlbum = $this->db->connect();
        // Preparar la consulta obteniendo el objeto PDOStatement
        $stmt = $bdAlbum->prepare($sql);
        // Vincular los parámetros
        $stmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
        // Ejecutamos sql
        $stmt->execute();

        // Validamos
        if ($stmt->rowCount() > 0) {
            return TRUE;
        }

        return FALSE; 

        } catch (PDOException $e) {
            // Manejo del error
            $this->handleError($e); 

        }
    }

    /*
        Método: update_num_fotos($id, $num)
        Descripción: Actualiza el contador de fotos de un álbum concreto
    */
    public function update_num_fotos(int $id, int $num) {
        try {
            $sql = "UPDATE albumes SET num_fotos = :num WHERE id = :id";
            $bdAlbum = $this->db->connect();
            $stmt = $bdAlbum->prepare($sql);
            $stmt->bindParam(':num', $num, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e); 
        }
    }

    /*
        Método: increment_visitas($id)
        Descripción: Suma 1 al contador de visitas de un álbum
    */
    public function increment_visitas(int $id) {
        try {
            // Usamos COALESCE por si el valor actual es NULL, que lo trate como 0
            $sql = "UPDATE albumes SET num_visitas = COALESCE(num_visitas, 0) + 1 WHERE id = :id";
            $bdAlbum = $this->db->connect();
            $stmt = $bdAlbum->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
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