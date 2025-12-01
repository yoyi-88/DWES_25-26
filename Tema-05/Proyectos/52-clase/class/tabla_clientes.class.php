<?php

/*
    clase: clase_tabla_clientes
    descripción: define la  clase que va a permitir realizar CRUD clientes en la tabla clientes de la base de datos fp:
        - index
        - añadir
        - actualizar
        - eliminar
        - buscar
        - ordenar
    
        herencia: clase_conexion

*/


class class_tabla_clientes extends class_conexion
{


    /*
        método:  get_libros()
        descripción: extrae los detallesde los libros que se van a mostrar en la vista principal
        parámetros:
        devuelve: devuelve un objeto de la clase pdo_statement con los registros obtenidos
        errores: muestra un mensaje de error si hay problemas con la base de datos
    */

    public function get_clientes()
    {

        try {

            $sql = "

            SELECT 
                c.id,
                c.apellidos,
                c.nombre,
                c.telefono,
                c.ciudad,
                c.dni,
                c.email
            FROM clientes AS c
            ORDER BY c.id ASC
    
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
        metodo: create()
        descripción: crea un nuevo libro en la base de datos
        
        parámetros: 
            - $libro: objeto de la clase class_libro con los datos del libro a crear 
            - $generos_id: array con los ids de los géneros asociados al libro
        devuelve: 
            - id del libro creado si se ha creado correctamente
            - false si hay algún error
    */
    
    public function create($cliente)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // preparo la consulta sql para insertar el libro
            $sql = "INSERT INTO clientes (
                        apellidos, 
                        nombre, 
                        telefono,
                        ciudad,
                        dni,
                        email
                    ) 
                    VALUES (
                        :apellidos, 
                        :nombre, 
                        :telefono, 
                        :ciudad, 
                        :dni,
                        :email
                    )";

            // creo el objeto pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // vinculo los parámetros
            $stmt->bindParam(':apellidos', $cliente->apellidos, PDO::PARAM_STR, 80);
            $stmt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR, 80);
            $stmt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR, 15);
            $stmt->bindParam(':ciudad', $cliente->ciudad, PDO::PARAM_STR, 50);
            $stmt->bindParam(':dni', $cliente->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':email', $cliente->email, PDO::PARAM_STR, 100);
           

            // ejecuto la consulta
            $stmt->execute();

            // obtengo el id del libro insertado
            $cliente_id = $this->pdo->lastInsertId();

            
            // confirmo la transacción
            $this->pdo->commit();

            // devuelvo el id del libro creado
            return $cliente_id;
        } catch (PDOException $e) {
                
                // si hay un error, hago rollback
                $this->pdo->rollBack();

                // muestro el error de base de datos
                include 'views/partials/errorDB.partial.php';
                return false;
        }

    }

    /*
        método: read()
        descripción: obtiene los detalles de un libro a partir de su id
        parámetros: 
            - $id: id del libro a obtener
        devuelve: 
            - objeto de la clase class_libro con los datos del libro
            - false si hay algún error
    */
    public function read($id)
    {
        try {

            $sql = "SELECT 
                        apellidos, 
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email
                    FROM clientes 
                    WHERE id = :id 
                    LIMIT 1";

            // creo el objeto pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // vinculo el parámetro
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecuto la consulta
            $stmt->execute();

            // establezco el modo de fetch a clase
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // obtengo el libro
            $cliente = $stmt->fetch();

            // devuelvo el libro
            return $cliente;
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

            // creo el objeto pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // vinculo el parámetro
            $stmt->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);

            // ejecuto la consulta
            $stmt->execute();

            // obtengo un array con los ids de los temas
            $temas_id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            // devuelvo el array con los ids de los temas
            return $temas_id;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        } 
    }
    
    

    /*
        método:  update()
        descripción: actualiza los detalles de un libro en la base de datos.
        Además debera actualizar los géneros asociados al libro.
        parámetros: 
            - $libro: objeto de la clase class_libro con los datos del libro a actualizar 
            - $id: id del libro a actualizar
        devuelve: 
            - true si se ha actualizado correctamente
            - false si hay algún error
    */

    public function update(class_cliente $cliente, $id)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // preparo la consulta sql para actualizar el libro
            $sql = "UPDATE clientes 
                    SET 
                        apellidos = :apellidos,
                        nombre = :nombre, 
                        telefono = :telefono, 
                        ciudad = :ciudad, 
                        dni = :dni,
                        email = :email, 
                    
                    WHERE id = :id 
                    LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            // vinculo los parámetros
            $stmt->bindParam(':apellidos', $cliente->apellidos, PDO::PARAM_STR, 13);
            $stmt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR, 80);
            $stmt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_INT);
            $stmt->bindParam(':ciudad', $cliente->ciudad, PDO::PARAM_INT);
            $stmt->bindParam(':dni', $cliente->dni, PDO::PARAM_STR, 10);
            $stmt->bindParam(':email', $cliente->email, PDO::PARAM_INT);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecuto la consulta
            $stmt->execute();
            
            // confirmo la transacción
            $this->pdo->commit();

            // devuelvo true si se ha actualizado correctamente
            return true;
        } catch (PDOException $e) {
                // si hay un error,
                $this->pdo->rollBack();

                // muestro el error de base de datos
                include 'views/partials/errorDB.partial.php';

                // devuelvo false
                return false;
        }
    }

    /*
        método:  delete()
        descripción: elimina un libro de la base de datos
        parámetros: 
            - $id: id del libro a eliminar
        devuelve: 
            - true si se ha eliminado correctamente
            - false si hay algún error
    */
    
    public function delete($id)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // elimino los temas asociados al libro
            
            // Este código no sería necesario si la tabla libros_temas la 
            // clave ajena libro_id tuviera la opción ON DELETE CASCADE
            $sql_delete_temas = "DELETE FROM libros_temas WHERE libro_id = :libro_id";
            $stmt_delete_temas = $this->pdo->prepare($sql_delete_temas);
            $stmt_delete_temas->bindParam(':libro_id', $id);
            $stmt_delete_temas->execute();

            // preparo la consulta sql para eliminar el libro
            $sql = "DELETE FROM libros WHERE id = :id LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            // vinculo el parámetro
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecuto la consulta
            $stmt->execute();

            // confirmo la transacción
            $this->pdo->commit();

            // devuelvo true si se ha eliminado correctamente
            return true;
        } catch (PDOException $e) {
                // si hay un error, hago rollback
                $this->pdo->rollBack();

                include 'views/partials/errorDB.partial.php';
                return false;
        }
    }

    /*
        método:  order_by()
        descripción: ordena los libros en la base de datos por un campo determinado
        parámetros: 
            - $criterio: número de la columna por la que se va a ordenar
            - Siempre es ASC
        devuelve: 
            - objeto pdo_statement con los resultados ordenados
            - false si hay algún error
    */
    public function order_by(int $criterio)
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
            ORDER BY :criterio ASC
    
            ";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // vinculo el parámetro criterio
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

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
        método:  filter()
        descripción: busca libros en la base de datos por título, autor, editorial o tema
        parámetros: 
            - $prompt: cadena de texto con la expresión de búsqueda
        devuelve: 
            - objeto pdo_statement con los resultados de la búsqueda
            - false si hay algún error
    */
    public function filter($prompt)
    {
        try {

            $sql = "

            SELECT *
                FROM (
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
                ) AS sub
            WHERE CONCAT_WS(' ', sub.id, sub.titulo, sub.autor, sub.editorial, sub.generos, sub.stock, sub.precio, '') LIKE :prompt
            ORDER BY sub.id ASC;


            ";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql2);

            // establezco el tipo de fetch a objeto
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // vinculo el parámetro de búsqueda con los comodines %
            $like_prompt = '%' . $prompt . '%';
            $stmt->bindParam(':prompt', $like_prompt, PDO::PARAM_STR);

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
}
