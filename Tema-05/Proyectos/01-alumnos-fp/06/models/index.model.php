<?php

/*
    modelo:  index.model.php
    descripción: obtiene los datos de alumnos necesarios para mostrarlo en la vista principal
*/

// Creo un objeto de la clase tabla_alumnos 
// Le envío los datos de conexión
$tabla_alumnos = new class_tabla_alumnos('localhost', 'root', '', 'fp');

// Obtengo un objeto de la clase mysqli_result con los detalles de los alumnos
$alumnos = $tabla_alumnos->get_alumnos();

// while ($alumno = $alumnos->fetch_assoc()) {
//     echo $alumno['id'] .  ' '.  $alumno['alumno'] . '<br>';

// }

?>