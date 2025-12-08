<?php

/*
    modelo: new.model.php
    descripción: modelo mostrar el formulario nuevo cliente
*/

// Conexión a la base de datos
$conexion = new class_tabla_clientes();

$clientes = $conexion->get_clientes();



?>