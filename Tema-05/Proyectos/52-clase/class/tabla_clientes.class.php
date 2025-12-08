<?php

/*
    clase: clase_tabla_clientes
    descripción: define la  clase que va a permitir realizar CRUD clientes en la tabla clientes de la base de datos gesbank:
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
        método:  get_clientes()
        descripción: extrae los detallesde los clientes que se van a mostrar en la vista principal
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
        descripción: crea un nuevo cliente en la base de datos
        
        parámetros: 
            - $cliente: objeto de la clase class_cliente con los datos del cliente a crear 
        devuelve: 
            - id del cliente creado si se ha creado correctamente
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

            // devuelvo el id del cliente creado
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
        descripción: obtiene los detalles de un cliente a partir de su id
        parámetros: 
            - $id: id del cliente a obtener
        devuelve: 
            - objeto de la clase class_cliente con los datos del cliente
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

            // obtengo el cliente
            $cliente = $stmt->fetch();

            // devuelvo el cliente
            return $cliente;
        } catch (PDOException $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        } 
    }

    /*
        método:  update()
        descripción: actualiza los detalles de un cliente en la base de datos.
        Además debera actualizar los géneros asociados al cliente.
        parámetros: 
            - $cliente: objeto de la clase class_cliente con los datos del cliente a actualizar 
            - $id: id del cliente a actualizar
        devuelve: 
            - true si se ha actualizado correctamente
            - false si hay algún error
    */

    public function update(class_cliente $cliente, $id)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // preparo la consulta sql para actualizar el cliente
            $sql = "UPDATE clientes 
                    SET 
                        apellidos = :apellidos,
                        nombre = :nombre, 
                        telefono = :telefono, 
                        ciudad = :ciudad, 
                        dni = :dni,
                        email = :email
                    
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
        descripción: elimina un cliente de la base de datos
        parámetros: 
            - $id: id del cliente a eliminar
        devuelve: 
            - true si se ha eliminado correctamente
            - false si hay algún error
    */
    
    public function delete($id)
    {
        try {

            // inicio transacción
            $this->pdo->beginTransaction();

            // preparo la consulta sql para eliminar el libro
            $sql = "DELETE FROM clientes WHERE id = :id LIMIT 1";

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
        descripción: ordena los clientes en la base de datos por un campo determinado
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
                c.id,
                c.apellidos,
                c.nombre,
                c.telefono,
                c.ciudad,
                c.dni,
                c.email
            FROM clientes AS c
            GROUP BY c.id
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
        descripción: busca clientes en la base de datos por nombre, apellidos, teléfono, ciudad, dni o email
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
                        c.id,
                        c.apellidos,
                        c.nombre,
                        c.telefono,
                        c.ciudad,
                        c.dni,
                        c.email
                    FROM clientes AS c
                    GROUP BY c.id
                ) AS sub
            WHERE CONCAT_WS(' ', sub.id, sub.apellidos, sub.nombre, sub.telefono, sub.ciudad, sub.dni, sub.email, '') LIKE :prompt
            ORDER BY sub.id ASC;


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
