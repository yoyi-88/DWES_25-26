<?php

/*
    modelo: edit.model.php
    descripción: obtiene los datos del libro a editar   

    Método GET:
            - id del libro a editar
    
*/

// Obtener id del libro
$libro_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$geslibros = new class_tabla_libros();

// Obtener datos del libro
$libro = $geslibros->read($libro_id);

// Obtener los array con los temas asociados al libro
// Creo un nuevo atributo en el objeto libro para almacenar los géneros
$libro->generos = $geslibros->temas_id_by_libro_id($libro_id);

// Obtener array asociativo id => nombre de los autores
$autores = $geslibros->get_autores();

// Obtener array asociativo id => nombre de las editoriales
$editoriales = $geslibros->get_editoriales();

// Obtener array asociativo id => nombre de los géneros
$generos = $geslibros->get_temas();


