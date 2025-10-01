<?php

    /* 
    * Ejemplo 2.7
    * Autor: yoyi
    * Descripción: Funciones strval, intval, floatval
    */
            $valor = 123.45;

            echo "Original: ";
            var_dump($valor);

            $str = strval($valor);
            echo "<br>strval: ";
            var_dump($str);

            $int = intval($valor);
            echo "<br>intval: ";
            var_dump($int);

            $float = floatval($valor);
            echo "<br>floatval: ";
            var_dump($float);




?>