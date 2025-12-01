<?php

/*
    clase: clase_tabla_cuentas
    descripción: define la  clase que va a permitir realizar CRUD libros en la tabla libros de la base de datos fp:
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

            $sql = "
                SELECT 
                    id, 
                    CONCAT(apellidos, ', ', nombre) AS nombre_completo 
                FROM clientes 
                ORDER BY apellidos ASC
            ";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // Ejecuto el comando sql
            $stmt->execute();

            // obtengo un array asociativo con los resultados
            // Clave (KEY): el id del cliente
            // Valor (PAIR): el nombre_completo (Apellidos, Nombre)
            $clientes = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            // devuelvo el array asociativo
            return $clientes;
            
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        } 
    }
    /*
        método: get_editoriales()
        descripción: obtiene un array asociativo con las editoriales de la base de datos
        Índices: id => nombre   
    */

    public function get_editoriales()
    {
        try {

            $sql = "SELECT id, nombre FROM editoriales ORDER BY nombre ASC";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // Ejecuto el  comando sql
            $stmt->execute();

            // obtengo un array asociativo con los resultados
            $editoriales = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            // devuelvo el array asociativo
            return $editoriales;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        } 
    }

    /*
        método: get_autores()
        descripción: obtiene un array asociativo con los autores de la base de datos
        Índices: id => nombre   
    */
    public function get_autores()
    {
        try {

            $sql = "SELECT id, nombre FROM autores ORDER BY nombre ASC";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // Ejecuto el  comando sql
            $stmt->execute();

            // obtengo un array asociativo con los resultados
            $autores = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            // devuelvo el array asociativo
            return $autores;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        } 
    }

    /*
        método: get_temas()
        descripción: obtiene un array asociativo con los temas de la base de datos
        Índices: id => tema   
    */
    public function get_temas()
    {
        try {

            $sql = "SELECT id, tema FROM temas ORDER BY tema ASC";

            // Ejecuto Prepare
            // Crear un objeto de la clase pdo_statement
            $stmt = $this->pdo->prepare($sql);

            // Ejecuto el  comando sql
            $stmt->execute();

            // obtengo un array asociativo con los resultados
            $temas = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            // devuelvo el array asociativo
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
            - $generos_id: array con los ids de los géneros asociados al libro
        devuelve: 
            - id del libro creado si se ha creado correctamente
            - false si hay algún error
    */
    
    public function create($datosCuenta)
{
    try {

        // 1. Inicio de la transacción (para garantizar que se cree la cuenta Y el movimiento, o ninguno)
        $this->pdo->beginTransaction();

        // 2. Preparar la consulta SQL para insertar la cuenta
        $sqlCuenta = "INSERT INTO cuentas (
                        num_cuenta, 
                        id_cliente, 
                        saldo, 
                        fecha_ul_mov, 
                        num_movtos
                      ) 
                      VALUES (
                        :num_cuenta, 
                        :id_cliente, 
                        :saldo_inicial, 
                        CURRENT_TIMESTAMP, 
                        1
                      )"; // Asumimos 1 movimiento: el de apertura

        // Creo el objeto pdo_statement para la cuenta
        $stmtCuenta = $this->pdo->prepare($sqlCuenta);

        // Vinculo los parámetros
        $stmtCuenta->bindParam(':num_cuenta', $datosCuenta->num_cuenta, PDO::PARAM_STR, 20);
        $stmtCuenta->bindParam(':id_cliente', $datosCuenta->id_cliente, PDO::PARAM_INT);
        $stmtCuenta->bindParam(':saldo_inicial', $datosCuenta->saldo_inicial, PDO::PARAM_STR);
        
        // Ejecuto la consulta de inserción de cuenta
        $stmtCuenta->execute();

        // 3. Obtengo el id de la cuenta insertada
        $cuenta_id = $this->pdo->lastInsertId();

        // 4. Insertar el movimiento inicial (Ingreso por apertura)
        $sqlMovimiento = "INSERT INTO movimientos (
                            id_cuenta, 
                            concepto, 
                            tipo, 
                            cantidad, 
                            saldo
                          ) 
                          VALUES (
                            :id_cuenta, 
                            :concepto, 
                            'I', 
                            :cantidad, 
                            :saldo_final
                          )";
        
        $concepto_apertura = $datosCuenta->concepto_inicial ?? "Apertura de cuenta con saldo inicial";

        $stmtMovimiento = $this->pdo->prepare($sqlMovimiento);
        $stmtMovimiento->bindParam(':id_cuenta', $cuenta_id, PDO::PARAM_INT);
        $stmtMovimiento->bindParam(':concepto', $concepto_apertura, PDO::PARAM_STR, 50);
        $stmtMovimiento->bindParam(':cantidad', $datosCuenta->saldo_inicial, PDO::PARAM_STR);
        $stmtMovimiento->bindParam(':saldo_final', $datosCuenta->saldo_inicial, PDO::PARAM_STR);

        $stmtMovimiento->execute();
        
        // 5. Confirmo la transacción
        $this->pdo->commit();

        // Devuelvo el id de la cuenta creada
        return $cuenta_id;

    } catch (PDOException $e) {
            
        // Si hay un error, hago rollback (deshacer todo)
        $this->pdo->rollBack();

        // Muestro el error de base de datos
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
                        id,
                        isbn,
                        titulo,
                        autor_id,
                        editorial_id,
                        precio_venta,
                        stock,
                        fecha_edicion
                    FROM libros 
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

    public function update(class_libro $libro, $id)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // preparo la consulta sql para actualizar el libro
            $sql = "UPDATE libros 
                    SET 
                        isbn = :isbn,
                        titulo = :titulo, 
                        autor_id = :autor_id, 
                        editorial_id = :editorial_id, 
                        precio_venta = :precio_venta,
                        stock = :stock, 
                        fecha_edicion = :fecha_edicion
                    
                    WHERE id = :id 
                    LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            // vinculo los parámetros
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 13);
            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 80);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_STR, 10);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecuto la consulta
            $stmt->execute();

            // elimino los temas asociados al libro
            $sql_delete_temas = "DELETE FROM libros_temas WHERE libro_id = :libro_id";
            $stmt_delete_temas = $this->pdo->prepare($sql_delete_temas);
            $stmt_delete_temas->bindParam(':libro_id', $id);
            $stmt_delete_temas->execute();

            // inserto los nuevos temas asociados al libro
            foreach ($libro->generos_id as $tema_id) {
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
