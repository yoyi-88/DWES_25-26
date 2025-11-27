<?php

/*
    clase: clase_tabla_libros
    descripción: define la  clase que va a permitir realizar CRUD libros:
        - index
        - añadir
        - actualizar
        - eliminar
        - buscar
        - ordenar
    
        herencia: clase padre class_conexion

*/


class class_tabla_libros extends class_conexion
{


    /*
    método:  get_libros()
    descripción: extrae los libros de  la  tabla  libros
    parámetros:
    devuelve: objeto de  la  clase  mysqli_result
    */

    public function get_libros()
    {

        try {

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

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // establezco el tipo de fetch a objeto
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecuto el  comando sql
            $stmt->execute();

            // devuelve objeto de la clase pdo_statement
            return $stmt;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
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

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // ejecuto el  comando sql
            $stmt->execute();

            // obtengo array asociativo
            $editoriales = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            // devuelvo array asociativo
            return $editoriales;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        }
        
    }

    /*
    método:  get_autories()
    descripción: obtiene un array acociativo con los autores de la base de datos
    */
    
    public function get_autores() {
        try {

            $sql = "SELECT id, nombre FROM autores ORDER BY nombre ASC";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // ejecuto el  comando sql
            $stmt->execute();

            // obtengo array asociativo
            $autores = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            // devuelvo array asociativo
            return $autores;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        }
    }

    public function get_temas() {
        try {

            $sql = "SELECT id, tema FROM temas ORDER BY tema ASC";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // ejecuto el  comando sql
            $stmt->execute();

            // obtengo array asociativo
            $temas = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            // devuelvo array asociativo
            return $temas;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        }
    }

    /*
        metodo: create()
        descripción: crea un nuevo libro en la base de datos
        
        parámetros: 
            - $libro: objeto de la clase class_libro con los datos del libro a crear 
        devuelve: 
            - id del libro creado si se ha creado correctamente
            - false si hay algún error
    */
    
    public function create($libro, $generos_id)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // preparo la consulta sql para insertar el libro
            $sql = "INSERT INTO libros (
                isbn,
                titulo, 
                autor_id, 
                editorial_id, 
                precio_venta, 
                stock, 
                fecha_edicion
                ) 
                VALUES (:isbn, 
                :titulo, 
                :autor_id, 
                :editorial_id, 
                :precio_venta, 
                :stock, 
                :fecha_edicion
                )";

            $stmt = $this->pdo->prepare($sql);

            // vinculo los parámetros
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 13);
            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 80);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_STR, 10);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);

            // ejecuto la consulta
            $stmt->execute();

            // obtengo el id del libro insertado
            $libro_id = $this->pdo->lastInsertId();

            // inserto los temas asociados al libro
            foreach ($generos_id as $tema_id) {
                $sql_tema = "INSERT INTO libros_temas (libro_id, tema_id) VALUES (:libro_id, :tema_id)";
                $stmt_tema = $this->pdo->prepare($sql_tema);
                $stmt_tema->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);
                $stmt_tema->bindParam(':tema_id', $tema_id, PDO::PARAM_INT);
                $stmt_tema->execute();
            }
            
            // confirmo la transacción
            $this->pdo->commit();

            // devuelvo el id del libro creado
            return $libro_id;
        } catch (PDOException $e) {
                // si hay un error, hago rollback
                $this->pdo->rollBack();

                include 'views/partials/errorDB.partial.php';
                return false;
        }

    }

    /*
        método: read()
        descripción: obtiene los datos de un libro por su id

        parámetros:
            - $libro_id: id del libro a obtener

        devuelve:
            - objeto de la clase class_libro con los datos del libro
            - false si hay algún error
    */
    public function read($libro_id)
    {
        try {

            $sql = "SELECT 
                        id,
                        isbn,
                        titulo,
                        autor_id,
                        editorial_id,
                        precio_venta,
                        stock,
                        fecha_edicion
                    FROM libros
                    WHERE id = :libro_id";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // vinculo el parámetro
            $stmt->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);

            // establezco el tipo de fetch a objeto
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecuto el  comando sql
            $stmt->execute();

            // obtengo el libro
            $libro = $stmt->fetch();

            // devuelvo el libro
            return $libro;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        }
    }

    /*
        método: temas_id_by_libro_id()
        descripción: obtiene un array con los ids de los temas asociados a un libro
        parámetros:
            - $libro_id: id del libro
        devuelve:
            - array con los ids de los temas asociados al libro
   */
    public function temas_id_by_libro_id($libro_id)
    {
        try {

            $sql = "SELECT tema_id FROM libros_temas WHERE libro_id = :libro_id";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // vinculo el parámetro
            $stmt->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);

            // Ejecuto el  comando sql
            $stmt->execute();

            // obtengo los ids de los temas
            $temas_ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            // devuelvo el array de ids de temas
            return $temas_ids;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        }
    }
}
