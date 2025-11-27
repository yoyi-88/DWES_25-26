<?php

/*
    modelo: edit.model.php
    descripción: obtiene los datos del formulario de edición del libro  

    Método GET:

            - id del libro
    
*/

// Obtener id libro a editar
$libro_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$geslibros = new class_tabla_libros();

// Obtener datos del alumno
$libro = $geslibros->read($libro_id);

// Obtener ids de los temas asociados al libro
// crea un nuevo atributo en el objeto libro para almacenar los géneros
$libro->generos = $geslibros->temas_id_by_libro_id($libro_id);

// Obtener todos los autores
$autores = $geslibros->get_autores();
// Obtener todas las editoriales
$editoriales = $geslibros->get_editoriales();
// Obtener todos los géneros
$generos = $geslibros->get_temas();





