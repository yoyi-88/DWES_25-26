<?php

/*
    modelo: update.model.php
    descripción: actualiza los datos de un libro en la base de datos
    a partir de los datos recibidos del formulario update.view.php
    
    Métod POST:
        
        - Los detalles del libro:
    
    Método GET:

        - id: id del libro
    
*/

// Obtener id del libro a actualizar
$cliente_id = $_GET['id'] ?? null;

// Obtener datos del formulario
$apellidos = $_POST['apellidos'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$ciudad = $_POST['ciudad'] ?? null;
$dni = $_POST['dni'] ?? null;
$email = $_POST['email'] ?? null;


// Crear objeto classs_libro
$cliente = new class_cliente(
    null,
    $apellidos,
    $nombre,
    $telefono,
    $ciudad,
    $dni,
    $email
);

// Añado la propiedad generos_id al objeto libro
// con los géneros seleccionados en el formulario
$libro->generos_id = $generos_id;

// Conexión a la base de datos
$gesbank = new class_tabla_clientes();

// Actualizar alumno
// y cmprobar si se ha actualizado correctamente
if ($gesbank->update($cliente, $cliente_id)) {
    // Éxito
    $notify = "Libro actualizado correctamente.";
} else {
    // Error
    $error = "Error al actualizar el libro: ";
}

// Obtener lista actualizada de libros
$libros = $geslibros->get_libros();



