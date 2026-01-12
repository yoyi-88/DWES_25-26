<?php

/*
    modelo:  search.model.php
    descripción: Modelo para filtrar la tabla clientes a partir de un prompt de búsqueda

    Parámetros GET:

    - $prompt : expresión de búsqueda

*/

// obtener criterio ordenación
$prompt = $_GET['prompt'] ?? null;

// Conectar base de datos
$gesbank = new class_tabla_clientes();

// Ejecutar filtro
$clientes = $gesbank->filter($prompt);

// notificación 
$notify = "Mostrando resultados para la búsqueda: '$prompt'";


?>