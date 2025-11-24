<?php
    /*
        modelo: index.model.php
        descripcion: obtiene los datos de alumnos necesarios para mostrarlo en le cista principal
    */

    // Creo un objeto de la clase tabla_alumnos
    // Le envío los datos de conexión
    $tabla_alumnos = new class_tabla_alumnos('localhost', 'root', '', 'fp');

    $alumnos = $tabla_alumnos->get_alumnos();
    
    /*while ($alumno = $alumnos->fetch_assoc()) {
        echo $alumno['id'] . ' ' .  $alumno['alumno'] . '<br>';

    }*/

?>