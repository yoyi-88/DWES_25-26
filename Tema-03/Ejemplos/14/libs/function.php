<?php
/*
Descripción: Librería con funciones reutilizables
*/

// Función suma dos números

function suma(int $a, int $b) {
    return $a + $b;
}

function resta(int $a, int $b) {
    return $a - $b;
}

function division(int $a, int $b) {
    if ($b === 0) {
        return "Error: División por cero.";
    }
    return $a / $b;
}



?>