<?php

/*
    clase: clase_tabla_cuentas
    descripción: define la  clase que va a permitir realizar CRUD libros en la tabla cuentas de la base de datos gesbank:
        - index
        - añadir
        - actualizar
        - eliminar
        - buscar
        - ordenar
    
        herencia: clase_conexion

*/


class class_tabla_cuentas extends class_conexion
{


    
    public function getCuentas()
{
    try {
        // Consulta para obtener las cuentas junto al nombre y apellido del cliente
        $sql = "
            SELECT 
                c.id, 
                c.num_cuenta,
                cl.nombre, 
                cl.apellidos, 
                c.fecha_alta,
                c.fecha_ul_mov,
                c.num_movtos,
                c.saldo
                
                
            FROM 
                cuentas AS c
            INNER JOIN 
                clientes AS cl ON c.id_cliente = cl.id
            ORDER BY 
                c.id ASC
        ";

        // Preparar la sentencia (usando el objeto PDO de la clase)
        $stmt = $this->pdo->prepare($sql);

        // Establecer el modo de fetch a objeto
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        // Ejecutar el comando SQL
        $stmt->execute();

        // Devolver el objeto PDOStatement con los resultados
        return $stmt;

    } catch (PDOException $e) {

        // En caso de error, incluir el parcial de error de base de datos
        include 'views/partials/errorDB.partial.php';

        // Detener la ejecución 
        return false;
    } 
}

public function getClientes()
{
    try {
        // Consulta para obtener todos los campos de la tabla clientes
        $sql = "
            SELECT 
                id,
                apellidos,
                nombre,
                telefono,
                ciudad,
                dni,
                email 
            FROM clientes
            ORDER BY 
                id ASC
        ";

        // Preparar la sentencia
        $stmt = $this->pdo->prepare($sql);

        // Establecer el modo de fetch a objeto
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        // Ejecutar el comando SQL
        $stmt->execute();

        // Devolver el objeto PDOStatement con los resultados
        return $stmt;

    } catch (PDOException $e) {

        // En caso de error, muestra el error de base de datos
        // Asegúrate de que esta vista exista en tu proyecto
        include 'views/partials/errorDB.partial.php';

        // Detener la ejecución 
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
    
    public function create($libro)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // preparo la consulta sql para insertar el libro
            $sql = "INSERT INTO libros (titulo, autor_id, editorial_id, stock, precio_venta) 
                    VALUES (:titulo, :autor_id, :editorial_id, :stock, :precio_venta)";

            $stmt = $this->pdo->prepare($sql);

            // vinculo los parámetros
            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 80);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_STR, 10);

            // ejecuto la consulta
            $stmt->execute();

            // obtengo el id del libro insertado
            $libro_id = $this->pdo->lastInsertId();

            // inserto los temas asociados al libro
            foreach ($libro->temas as $tema_id) {
                $sql_tema = "INSERT INTO libros_temas (libro_id, tema_id) VALUES (:libro_id, :tema_id)";
                $stmt_tema = $this->pdo->prepare($sql_tema);
                $stmt_tema->bindParam(':libro_id', $libro_id);
                $stmt_tema->bindParam(':tema_id', $tema_id);
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
        método:  update()
        descripción: actualiza los detalles de un libro en la base de datos
        parámetros: 
            - $libro: objeto de la clase class_libro con los datos del libro a actualizar 
            - $id: id del libro a actualizar
        devuelve: 
            - true si se ha actualizado correctamente
            - false si hay algún error
    */

    public function update(class_libro $libro, $id)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // preparo la consulta sql para actualizar el libro
            $sql = "UPDATE libros 
                    SET titulo = :titulo, autor_id = :autor_id, editorial_id = :editorial_id, stock = :stock, precio_venta = :precio_venta 
                    WHERE id = :id LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            // vinculo los parámetros
            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 80);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_STR, 10);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecuto la consulta
            $stmt->execute();

            // elimino los temas asociados al libro
            $sql_delete_temas = "DELETE FROM libros_temas WHERE libro_id = :libro_id";
            $stmt_delete_temas = $this->pdo->prepare($sql_delete_temas);
            $stmt_delete_temas->bindParam(':libro_id', $id);
            $stmt_delete_temas->execute();

            // inserto los nuevos temas asociados al libro
            foreach ($libro->temas as $tema_id) {
                $sql_tema = "INSERT INTO libros_temas (libro_id, tema_id) VALUES (:libro_id, :tema_id)";
                $stmt_tema = $this->pdo->prepare($sql_tema);
                $stmt_tema->bindParam(':libro_id', $id);
                $stmt_tema->bindParam(':tema_id', $tema_id);
                $stmt_tema->execute();
            }
            
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
            // este código no sería necesario si la tabla libros_temas la 
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
        método:  sort()
        descripción: ordena los libros en la base de datos por un campo determinado
        parámetros: 
            - $criterio: número de la columna por la que se va a ordenar
            - Siempre es ASC
        devuelve: 
            - objeto pdo_statement con los resultados ordenados
            - false si hay algún error
    */
    public function sort($criterio)
    {
        try {

            // defino el campo por el que se va a ordenar
            switch ($criterio) {
                case 1:
                    $order_by = 'l.titulo';
                    break;
                case 2:
                    $order_by = 'a.nombre';
                    break;
                case 3:
                    $order_by = 'e.nombre';
                    break;
                case 4:
                    $order_by = 'l.stock';
                    break;
                case 5:
                    $order_by = 'l.precio_venta';
                    break;
                default:
                    $order_by = 'l.id';
            }

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
            ORDER BY $order_by ASC
    
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
        método:  search()
        descripción: busca libros en la base de datos por título, autor, editorial o tema
        parámetros: 
            - $prompt: cadena de texto con la expresión de búsqueda
        devuelve: 
            - objeto pdo_statement con los resultados de la búsqueda
            - false si hay algún error
    */
    public function search($prompt)
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
            WHERE 
                l.titulo LIKE :prompt OR 
                a.nombre LIKE :prompt OR 
                e.nombre LIKE :prompt OR 
                t.tema LIKE :prompt
            GROUP BY l.id
            ORDER BY l.id ASC
    
            ";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

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
