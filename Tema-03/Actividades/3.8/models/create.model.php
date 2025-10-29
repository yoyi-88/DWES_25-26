<?php
/*
    Modelo para añadir un nuevo libro al array de libros

    Método POST:
        - id
        - titulo
        - autor
        - genero
        - precio
        - editorial
    */

    // Obtenemos los datos del formulario
    $id = $_POST['id'] ?? null;
    $titulo = $_POST['titulo'] ?? null;
    $autor = $_POST['autor'] ?? null;
    $editorial = $_POST['editorial'] ?? null;
    $genero = $_POST['genero'] ?? null;
    $precio = $_POST['precio'] ?? null;
    

    // Creamos el array asociativo del nuevo libro
    $nuevo_libro = [
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'editorial' => $editorial,
        'genero' => $genero,
        'precio' => (float)$precio
        
    ];

    // Cargamos el array de libros existente
    $libros = get_tabla_libros();

    // Añadir nuevo libro al array de libros
    $libros[] = $nuevo_libro;


?>