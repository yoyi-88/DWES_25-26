<?php

/*
    clase: clase_tabla_alumnos
    descripción: define la  clase que va a permitir realizar CRUD alumnos:
        - index
        - añadir
        - actualizar
        - eliminar
        - buscar
        - ordenar
    
        herencia: clase padre class_conexion

*/


class class_tabla_alumnos extends class_conexion
{


    /*
    método:  get_alumnos()
    descripción: extrae los alumnos de  la  tabla  alumnos
    parámetros:
    devuelve: objeto de  la  clase  mysqli_result
    */

    public function get_alumnos()
    {

        try {

            $sql = "

            select 
                    alumnos.id,
                    concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                    alumnos.email,
                    alumnos.nacionalidad,
                    alumnos.dni,
                    timestampdiff(YEAR,  alumnos.fecha_nac, now()) as edad,
                    cursos.nombreCorto as curso
            FROM alumnos INNER JOIN cursos
            ON alumnos.curso_id = cursos.id
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

    /*
    método:  get_curos()
    descripción: extrae todos los cursos de la base de datos fp
    parámetros:
    devuelve: array asociativo con los cursos con id y curso
    */

    public function get_cursos()
    {

        try {

            $sql = "

            select 
                    id,
                    nombreCorto as curso
            FROM cursos
            ORDER BY 2
    
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

    /*
        método: create()
        descripción: añade un nuevo alumno a la tabla alumnos
        parámetros: objeto de la clase class_alumno 
        devuelve: nulo

    */
    public function create(class_alumno $alumno)
    {
        try {

            // Crear la sentencia preparada
            $sql = "
                    INSERT INTO 
                        alumnos( 
                                nombre,
                                apellidos,
                                email,
                                telefono,
                                nacionalidad,
                                dni, 
                                fecha_nac,
                                curso_id
                            )
                    VALUES    (?, ?, ?, ?, ?, ?, ?, ?)                            
                    ";

            // ejecuto la sentenecia preprada y obtengo el objeto mysqli_stmt
            $stmt = $this->mysqli->prepare($sql);

            // compruebo prepare
            if (!$stmt) {
                throw new mysqli_sql_exception("Error en prepare(): " . $this->mysqli->error);
            }

            // vinculación de parámetros
            $stmt->bind_param(
                'sssisssi',
                $alumno->nombre,
                $alumno->apellidos,
                $alumno->email,
                $alumno->telefono,
                $alumno->nacionalidad,
                $alumno->dni,
                $alumno->fecha_nac,
                $alumno->curso_id
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

    /*
        método: read()
        descripción: obtiene los datos de un alumno a partir de su id
        parámetros: id del alumno
        devuelve: objeto de la clase class_alumno
    */

    public function read($id)
    {
        try {

            // Crear la sentencia sql
            $sql = "SELECT * FROM alumnos WHERE id = ? LIMIT 1";

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

    /*
        método: update()
        descripción: actualiza los datos de un alumno en la base de datos
        parámetros: 
            - objeto de la clase class_alumno 
            - id del alumno a actualizar
        devuelve: nulo
    */

    public function update(class_alumno $alumno, $alumno_id)
    {
        try {

            // Crear la sentencia preparada
            $sql = "
                    UPDATE 
                        alumnos
                    SET 
                        nombre = ?,
                        apellidos = ?,
                        email = ?,
                        telefono = ?,
                        nacionalidad = ?,
                        dni = ?, 
                        fecha_nac = ?,
                        curso_id = ?
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
                'sssisssii',
                $alumno->nombre,
                $alumno->apellidos,
                $alumno->email,
                $alumno->telefono,
                $alumno->nacionalidad,
                $alumno->dni,
                $alumno->fecha_nac,
                $alumno->curso_id,
                $alumno_id
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

    /*
        método: delete()
        descripción: elimina un alumno de la base de datos
        parámetros: id: del alumno a eliminar
        devuelve: nulo
    */
    public function delete($id)
    {
        try {

            // Crear la sentencia sql
            $sql = "DELETE FROM alumnos WHERE id = ? LIMIT 1";

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

            return true;
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

    /*
        método: order_by()
        descripción: obtiene los alumnos ordenados por el campo indicado
        parámetros: 
            - $criterio : nº del campo por el que se ordena
        
        devuelve: objeto de la clase mysqli_result
    */

    public function order_by($criterio)
    {
        try {



            $sql = "

            select 
                    alumnos.id,
                    concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                    alumnos.email,
                    alumnos.nacionalidad,
                    alumnos.dni,
                    timestampdiff(YEAR,  alumnos.fecha_nac, now()) as edad,
                    cursos.nombreCorto as curso
            FROM alumnos INNER JOIN cursos
            ON alumnos.curso_id = cursos.id
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

    /*
        método: filter()
        descripción: obtiene los alumnos que coinciden con el criterio de búsqueda
        parámetros: 
            - $prompt : cadena de búsqueda
        
        devuelve: objeto de la clase mysqli_result          

    */
    public function filter($prompt)
    {
        try {

            // sentencia sql
            $sql = "
            select 
                alumnos.id,
                concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                alumnos.email,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR,  alumnos.fecha_nac, now()) as edad,
                cursos.nombreCorto as curso
            FROM 
                alumnos 
            INNER JOIN
                cursos
            ON alumnos.curso_id = cursos.id
            WHERE 
            CONCAT_WS(' ',
                        alumnos.id, 
                        alumnos.nombre,
                        alumnos.apellidos, 
                        alumnos.email, 
                        alumnos.telefono, 
                        alumnos.nacionalidad, 
                        alumnos.dni, 
                        TIMESTAMPDIFF(YEAR, alumnos.fecha_nac, NOW()),
                        alumnos.fecha_nac, 
                        cursos.nombreCorto,
                        cursos.nombre,
                        cursos.ciclo) 
            LIKE ?

            ORDER BY alumnos.id
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
    // 
}
