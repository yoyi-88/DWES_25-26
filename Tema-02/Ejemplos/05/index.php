<?php

/*
 * Ejemplo 2.5
 * Autor: yoyi
 */

    define("PI", 3.1416); // Constante PI
    define("TASA_IVA", 0.21); // Constante TASA_IVA
    define("NOMBRE_EMPRESA", "ACME_SA");

    //Uso de las constantes
    echo "<p>Valor de PI: " . PI . "</p>";
    echo "<p>Tasa de IVA: " . (TASA_IVA * 100) . "%</p>";
    echo "<p>Nombre de la empresa: " . NOMBRE_EMPRESA . "</p>";

    // 4 características de las constantes:
    // 1. No llevan el símbolo $.
    // 2. Su valor no puede cambiar una vez definido.
    // 3. Se definen utilizando la función define().
    // 4. Por convención, se escriben en mayúsculas.
?>