<?php
    /*
    * Ejemplo 2.8
    * Autor: yoyi
    * Descripción: Uso de la función settype()
    */

    $var1 = 3.1416;
    echo "<p>Valor de var1: $var1</p>";
    settype($var1, "string");
    echo "<p>Valor de var1 como string: $var1</p>";
    settype($var1, "integer");
    echo "<p>Valor de var1 como integer: $var1</p>";
    settype($var1, "float");
    echo "<p>Valor de var1 como float: $var1</p>";

    // Si un string lo pasas a integer, el resultado es 0, pero si el string empieza con un número, toma ese número.
    $var2 = "123abc";
    echo "<p>Valor de var2: $var2</p>";
    settype($var2, "integer");
    echo "<p>Valor de var2 como integer: $var2</p>";
    settype($var2, "float");
    echo "<p>Valor de var2 como float: $var2</p>";
?>