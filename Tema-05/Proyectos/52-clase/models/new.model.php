<?php

/*
    modelo: new.model.php
    descripción: modelo mostrar el formulario nuevo libro
*/

// Conexión a la base de datos
$conexion = new class_tabla_clientes();

// Obtener array asociativo id => nombre de los autores
$clientes = $conexion->get_clientes();



?>