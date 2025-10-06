<?php

    /*
    *Controlador: calculos.php
    * Proyecto 2.2 - Cálculo de proyectiles con php
    * Autor: Yoël Gómez Benítez
    * Descripción: Este archivo procesa los calculos referentes al lanzamiento del proyectil en php
    */

    // Recogida de valores
    $velIn = $_POST["velocidadInicial"];
    $angulo = $_POST["anguloLanzamiento"];

    // El ángulo en radianes.
    $anguloRad = $angulo * (pi() / 180);

    // La velocidad inicial horizontal.
    $v0x = $velIn * cos($anguloRad);

    // La velocidad inicial vertical.
    $v0y = $velIn * sin($anguloRad);

    // El alcance máximo del proyectil.
    $alcanceMax = (pow($velIn, 2) * sin(2 * $anguloRad)) / 9.81;

    // La altura máxima alcanzada por el proyectil.
    $alturaMax = (pow($velIn, 2) * pow(sin($anguloRad), 2)) / (2 * 9.81);

    // El tiempo total de vuelo.
    $tiempoVuelo = (2 * $v0y) / 9.81;
?>