<?php
/*
Descripción: Uso de array como parámetro de una función
*/

function mostrar_alumno($alumno = []) {

    if (array_key_exists('nombre', $alumno)) {
        echo "Nombre: " . $alumno['nombre'] . "<br>";
    }
    if (array_key_exists('edad', $alumno)) {
        echo "Edad: " . $alumno['edad'] . "<br>";
    }
    if (array_key_exists('curso', $alumno)) {
        echo "Curso: " . $alumno['curso'] . "<br>";
    }
    if (array_key_exists('apellidos', $alumno)) {
        echo "Apellidos: " . $alumno['apellidos'] . "<br>";
    }
}




?>