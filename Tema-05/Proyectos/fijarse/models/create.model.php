<?php

/*
    modelo: craate.model.php
    descripción: añadir nuevo alumno a la tabla de alumnos
    
    
*/

// Recoger datos del formulario
$id_cliente = $_POST['id_cliente'] ?? null;
$num_cuenta = $_POST['num_cuenta'] ?? null;
$saldo_inicial = $_POST['saldo_inicial'] ?? 0.00;
$concepto_inicial = $_POST['concepto_inicial'] ?? 'Apertura de cuenta';


// Validar datos (omitir para simplificar)

// Crear objeto classs_libro
$datosCuenta = (object)[
    'id_cliente' => $id_cliente,
    'num_cuenta' => $num_cuenta,
    'saldo_inicial' => $saldo_inicial,
    'concepto_inicial' => $concepto_inicial
];
// Conexión a la base de datos
$gesbank = new class_tabla_cuentas();

// Añadir nuevo alumno
if ($gesbank->create($datosCuenta)) {
    // Éxito
    $notify = "Cuenta añadida correctamente.";
    header("Location: index.php?notify=$notify");
    exit();
} else {
    // Error
    $error = "Error al añadir la cuenta: ";
    header("Location: index.php?error=$error");
    exit();
}
?>
