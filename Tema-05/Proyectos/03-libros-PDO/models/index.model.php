<?php

/*
    modelo:  index.model.php
    descripción: obtiene los datos de alumnos necesarios para mostrarlo en la vista principal
*/

// Creo un objeto de la clase tabla_alumnos 
// Le envío los datos de conexión
$geslibros = new class_tabla_libros('localhost', 'root', '', 'fp');

// Obtengo un objeto de la clase mysqli_result con los detalles de los alumnos
$libros = $geslibros->get_libros();

// while ($alumno = $alumnos->fetch_assoc()) {
//     echo $alumno['id'] .  ' '.  $alumno['alumno'] . '<br>';

// }

?>