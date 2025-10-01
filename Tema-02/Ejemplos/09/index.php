<?php

    /*
    * Ejemplo 2.9
    * Autor: yoyi
    * Descripción: Conversiones implicitas de tipos de datos ejemplo (integer) y (float)
    */

    $var1 = 3.1416;
    echo "<p>Valor de var1: $var1</p>";
    echo "<p>Tipo de var1: " . gettype($var1) . "</p>";
    $var2 = (float) $var1;
    echo "<p>Valor de var2: $var2</p>";
    echo "<p>Tipo de var2: " . gettype($var2) . "</p>";

?>