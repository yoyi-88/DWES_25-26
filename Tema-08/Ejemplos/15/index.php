<?php
/*
    Ejemplo 15
    Descripcion: Gestión de ficheros csv en PHP

        - creear fichero csv
        - escribir en un fichero csv
        - leer un fichero csv
*/

// Crear un fichero csv

// Obtenemos los datos de la tabla alumnos mediante array indexado

// Para simplificar creo un array con los datos
$alumnos = [
    [
        1,
        'Juan',
        'Pérez García',
        '2DAW',
        'El Bosque'
    ],
    [
        2,
        'María',
        'García López',
        '2DAW',
        'El Bosque'
    ],
    [
        3,
        'Pedro',
        'López Martínez',
        '2DAW',
        'El Bosque'
    ],
    [
        4,
        'Ana',
        'Martínez Sánchez',
        '2DAW',
        'El Bosque'
    ],
    [
        5,
        'Luis',
        'Sánchez Rodríguez',
        '2DAW',
        'El Bosque'
    ]
];

// Abrimos el fichero en modo escritura
$fichero = fopen('csv/alumnos.csv', 'wb');

// Escribimos los datos en el fichero
foreach ($alumnos as $alumno) {
    fputcsv($fichero, $alumno, ";", '"');
}

// Cerramos el fichero
fclose($fichero);

// Mostramos mensaje
echo 'Fichero "alumnos.csv" creado correctamente.';

?>