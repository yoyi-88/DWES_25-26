<?php

    /*
        modelo: sumar.model.php
        Proyecto 2.1 - Calculadora Básica con PHP
        Autor: Yoël Gómez Benítez
        Fecha: 2025-10-01
        Descripción: Este script recibe dos valores numéricos desde un formulario HTML,
        los suma y muestra el resultado en una página web.
    */

    // recoger los valores del formulario
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];

    // realizar la suma
    $resultado = $valor1 + $valor2;

    // Operación
    $operacion = "suma";
 

?>