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

}


?>