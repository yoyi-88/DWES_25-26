<?php
/*
    clase: class_tabla_corredores
    descripción: define la  clase que va a permitir realizar CRUD corredores:
        - index
        - añadir
        - actualizar
        - eliminar
        - buscar
        - ordenar
    
        herencia: clase padre class_conexion

*/

class class_tabla_corredores extends class_conexion {

    /*
    método:  get_corredores()
    descripción: extrae los corredores de  la  tabla  corredores
    parámetros:
    devuelve: objeto de  la  clase  mysqli_result
    */

    public function get_corredores() {
        try {

            $sql= 
                "SELECT 
                    corredores.id,
                    corredores.nombre,
                    corredores.apellidos,
                    corredores.ciudad,
                    corredores.email,
                    TIMESTAMPDIFF(YEAR,
                        corredores.fechaNacimiento,
                        NOW()) AS edad,
                    categorias.nombrecorto AS categoria,
                    clubs.nombrecorto AS club
                FROM
                    corredores
                        INNER JOIN
                    categorias ON corredores.id_categoria = categorias.id
                        INNER JOIN
                    clubs ON corredores.id_club = clubs.id
                ORDER BY 1
            ";

            // Prepare
            $stmt = $this->mysqli->prepare($sql);

            // Comprobar prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // Ejecutamos consulta preparada
            $stmt->execute();

            // Devolvemos un objeto de la clase mysqli_result
            return $stmt->get_result();

        } catch(mysqli_sql_exception $e) {
            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // Paro la ejecucion
            return false;

        } finally {
            // libero sentencia preparada
            if(isset($stmt)) {
                $stmt->close();

            }

        }
    }

    public function get_categoria()
    {

        try {

            $sql = "

            select 
                    id,
                    nombreCorto as categoria
            FROM categorias
            ORDER BY 1
    
            ";

            // Prepare
            // Crear un objeto de la clase mysqli_stmt
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // No necesita  vincular parámetros
            // Ejecuto el  comando

            $stmt->execute();

            // devuelve un objeto de la clase mysqli_result
            $cursos = $stmt->get_result();

            // paso el resultado a un array asociativo
            return $cursos->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            exit();
        }
    }

    public function get_club()
    {

        try {

            $sql = "

            select 
                    id,
                    nombreCorto as club
            FROM clubs
            ORDER BY 1
    
            ";

            // Prepare
            // Crear un objeto de la clase mysqli_stmt
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // No necesita  vincular parámetros
            // Ejecuto el  comando

            $stmt->execute();

            // devuelve un objeto de la clase mysqli_result
            $cursos = $stmt->get_result();

            // paso el resultado a un array asociativo
            return $cursos->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            exit();
        }
    }

    public function create(class_corredor $corredor)
    {
        try {

            // Crear la sentencia preparada
            $sql = "
                    INSERT INTO 
                        corredores( 
                                nombre,
                                apellidos,
                                ciudad,
                                fechaNacimiento,
                                sexo,
                                email, 
                                dni,
                                id_categoria,
                                id_club
                            )
                    VALUES    (?, ?, ?, ?, ?, ?, ?, ?, ?)                            
                    ";

            // ejecuto la sentenecia preprada y obtengo el objeto mysqli_stmt
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // vinculación de parámetros
            $stmt->bind_param(
                'ssssssiii',
                $corredor->nombre,
                $corredor->apellidos,
                $corredor->ciudad,
                $corredor->fechaNacimiento,
                $corredor->sexo,
                $corredor->email,
                $corredor->dni,
                $corredor->id_categoria,
                $corredor->id_club
            );

            // Ejecuto la sentencia preparada insert
            $stmt->execute();

            // Obtengo el id del nuevo alumno insertado
            $new_id = $this->mysqli->insert_id;

            // devuelvo nuevo id
            return $new_id;
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.partial.php';

            // devuelvo false
            return false;
        } finally {

            // libero sentencia preprada
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }

    public function read($id)
    {
        try {

            // Crear la sentencia sql
            $sql = "SELECT * FROM corredores WHERE id = ? LIMIT 1";

            // Creo la sentencia preprada objeto clase mysqli_stmt
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // vinculación de parámetros
            $stmt->bind_param(
                'i',
                $id
            );

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase  mysqli_result
            $result = $stmt->get_result();

            // Devolvemos un objeto de la clase alumno
            return $result->fetch_object();
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.partial.php';

            // devuelvo false
            return false;
        } finally {

            // libero sentencia preprada
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }

    public function update(class_corredor $corredor, $corredor_id)
    {
        try {

            // Crear la sentencia preparada
            $sql = "
                    UPDATE 
                        corredores  
                    SET 
                        nombre = ?,
                        apellidos = ?,
                        ciudad = ?,
                        fechaNacimiento = ?,
                        sexo = ?,
                        email = ?, 
                        dni = ?,
                        id_categoria = ?,
                        id_club = ?
                    WHERE 
                        id = ?                            
                    ";

            // ejecuto la sentenecia preprada y obtengo el objeto mysqli_stmt
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // vinculación de parámetros
            $stmt->bind_param(
                'ssssssiiii',
                $corredor->nombre,
                $corredor->apellidos,
                $corredor->ciudad,
                $corredor->fechaNacimiento,
                $corredor->sexo,
                $corredor->email,
                $corredor->dni,
                $corredor->id_categoria,
                $corredor->id_club,
                $corredor_id
            );

            // Ejecuto la sentencia preparada update
            $stmt->execute();

            // devuelve true
            return true;
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución
            return false;
        } finally {

            // libero sentencia preprada
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }

    public function delete($id)
{
    // Usaremos una variable para almacenar si la operación fue exitosa
    $corredor_eliminado = false;
    
    try {
        
        // Crear la sentencia sql para borrar de la tabla 'Registros'
        $sql_registros = "DELETE FROM registros WHERE id_corredor = ?";
        
        // Creo la sentencia preprada objeto clase mysqli_stmt
        $stmt_registros = $this->mysqli->prepare($sql_registros);

        // compruebo prepare
        if (!$stmt_registros) {
            throw new mysqli_sql_exception("Error en prepare (Registros): " . $this->mysqli->error);
        }

        // vinculación de parámetros
        $stmt_registros->bind_param(
            'i',
            $id
        );

        // ejecutamos
        $stmt_registros->execute();

        // Cierra la sentencia de Registros inmediatamente
        $stmt_registros->close();


        
        // Crear la sentencia sql para borrar de la tabla 'Corredores'
        $sql_corredor = "DELETE FROM corredores WHERE id = ? LIMIT 1";

        // Creo la sentencia preprada objeto clase mysqli_stmt
        $stmt_corredor = $this->mysqli->prepare($sql_corredor);

        // compruebo prepare
        if (!$stmt_corredor) {
            throw new mysqli_sql_exception("Error en prepare (Corredores): " . $this->mysqli->error);
        }

        // vinculación de parámetros
        $stmt_corredor->bind_param(
            'i',
            $id
        );

        // ejecutamos
        $stmt_corredor->execute();
        
        // Si llegamos aquí sin errores, la operación fue exitosa
        $corredor_eliminado = true;
        
    } catch (mysqli_sql_exception $e) {

        // error de base dedatos
        include 'views/partials/errorDB.partial.php';

        // devuelvo false
        $corredor_eliminado = false;
        
    } finally {

        // libero sentencia preprada para Corredores
        if (isset($stmt_corredor)) {
            $stmt_corredor->close();
        }
        
        // Como 'stmt_registros' se cerró justo después de ejecutarse,
        // no es necesario un cierre adicional aquí.
        
        return $corredor_eliminado;
    }
}

public function order_by($criterio)
    {
        try {



            $sql = "

            select 
                    corredores.id,
                    corredores.nombre,
                    corredores.apellidos,
                    corredores.ciudad,
                    corredores.email,
                    TIMESTAMPDIFF(YEAR,
                        corredores.fechaNacimiento,
                        NOW()) AS edad,
                    categorias.nombrecorto AS categoria,
                    clubs.nombrecorto AS club
                FROM
                    corredores
                        INNER JOIN
                    categorias ON corredores.id_categoria = categorias.id
                        INNER JOIN
                    clubs ON corredores.id_club = clubs.id
                ORDER BY ?
    
            ";

            // Prepare
            // Crear un objeto de la clase mysqli_stmt
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // vinculación de parámetros
            $stmt->bind_param(
                'i',
                $criterio
            );

            // No necesita  vincular parámetros
            // Ejecuto el  comando
            $stmt->execute();

            // devuelve un objeto de la clase mysqli_result
            return $stmt->get_result();
        } catch (mysqli_sql_exception $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;
        } finally {

            // libero sentencia preprada
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }

    public function filter($prompt)
    {
        try {

            // sentencia sql
            $sql = "
            SELECT 
                corredores.id,
                corredores.nombre,
                corredores.apellidos,
                corredores.email,
                corredores.ciudad,
                corredores.dni,
                TIMESTAMPDIFF(YEAR, corredores.fechaNacimiento, NOW()) AS edad,
                corredores.fechaNacimiento,
                categorias.nombrecorto AS categoria,
                clubs.nombrecorto AS club
            FROM 
                corredores 
            INNER JOIN
                categorias ON corredores.id_categoria = categorias.id
            INNER JOIN
                clubs ON corredores.id_club = clubs.id
            WHERE 
                CONCAT_WS(' ',
                    corredores.id, 
                    corredores.nombre,
                    corredores.apellidos, 
                    corredores.email, 
                    corredores.ciudad, 
                    corredores.dni, 
                    TIMESTAMPDIFF(YEAR, corredores.fechaNacimiento, NOW()),
                    corredores.fechaNacimiento, 
                    categorias.nombrecorto,
                    categorias.nombre,
                    clubs.nombrecorto,
                    clubs.nombre)
            LIKE ?
            ORDER BY corredores.id
            ";

            // ejecuto prepare
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // arreglamos expresión para operador like
            $prompt = '%' . $prompt . '%';

            // vincular parámetros
            $stmt->bind_param(
                's',
                $prompt
            );

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase  mysqli_result
            $result = $stmt->get_result();

            // Devolvemos mysqli_result
            return $result;
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.partial.php';

            return false;
        } finally {

            // libero sentencia preprada
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }

    public function categorias_indices_a_nombres() {
        $categorias = [];

        try {
            $sql = "SELECT id, nombrecorto FROM categorias";

            // Prepare
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // Ejecuto el  comando
            $stmt->execute();

            // devuelve un objeto de la clase mysqli_result
            $result = $stmt->get_result();

            // paso el resultado a un array asociativo
            while ($row = $result->fetch_assoc()) {
                $categorias[$row['id']] = $row['nombrecorto'];
            }

            return $categorias;

        } catch (mysqli_sql_exception $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;

        } finally {
            // libero sentencia preprada
            if (isset($stmt)) {
                $stmt->close();

            }
    }
}

    public function clubs_indices_a_nombres() {
        $clubs = [];

        try {
            $sql = "SELECT id, nombrecorto FROM clubs";

            // Prepare
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // Ejecuto el  comando
            $stmt->execute();

            // devuelve un objeto de la clase mysqli_result
            $result = $stmt->get_result();

            // paso el resultado a un array asociativo
            while ($row = $result->fetch_assoc()) {
                $clubs[$row['id']] = $row['nombrecorto'];
            }

            return $clubs;

        } catch (mysqli_sql_exception $e) {

            // mostrar error de base de datos
            include 'views/partials/errorDB.partial.php';

            // paro la ejecución 
            return false;

        } finally {
            // libero sentencia preprada
            if (isset($stmt)) {
                $stmt->close();

            }
        }

}

}


?>