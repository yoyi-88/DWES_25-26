<?php
    /*
    */


    // Recibimos los valores del formulario mediante el método GET
    $valor1 = $_GET['valor1'] ?? null;
    $valor2 = $_GET['valor2'] ?? null;
    $operacion = $_GET['operacion'] ?? null;

    // Creamos una instancia de la clase
    $calculadora = new Class_calculadora($valor1, $valor2, $operacion, null);

    switch ($operacion) {
        case 'Sumar':
            $resultado = $calculadora->sumar();
            break;
        case 'Restar':
            $resultado = $calculadora->restar();
            break;
        case 'Multiplicar':
            $resultado = $calculadora->multiplicar();
            break;
        case 'Dividir':
            $resultado = $calculadora->dividir();
            break;
    }

?>