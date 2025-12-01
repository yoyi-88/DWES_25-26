<?php

/*
    modelo:  search.model.php
    descripción: Modelo para filtrar la tabla libros a partir de un prompt de búsqueda

    Parámetros GET:

    - $prompt : expresión de búsqueda

*/

// obtener criterio ordenación
$prompt = $_GET['prompt'] ?? null;

// Conectar base de datos
$geslibros = new class_tabla_libros();

// Ejecutar filtro
$libros = $geslibros->filter($prompt);

// notificación 
$notify = "Mostrando resultados para la búsqueda: '$prompt'";


?>