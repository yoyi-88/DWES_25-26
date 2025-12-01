<?php

/*
    modelo: edit.model.php
    descripción: obtiene los datos del formulario de edición de una cuenta  

    Método GET:

            - id de la cuenta
    
*/

$cuenta_id = $_GET['id'] ?? null;


$conexion = new class_tabla_cuentas();

$cuenta = $conexion->read($cuenta_id);


$cuentas = $conexion->get_cuentas();


