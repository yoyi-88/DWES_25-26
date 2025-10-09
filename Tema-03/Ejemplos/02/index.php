<?php

    /**
        * Ejemplo 3.2 - if ... else
        * Descripción: Determinar la calificación de un examen cuya nota está comprendida entre 0 y 10
        * La calificación será: suspenso (0-4), aprobado (5-6), notable (7-8) y sobresaliente (9-10)
        */

    $nota = 7;

    if ($nota < 5) {
        echo "Suspenso";
    } else if ($nota >= 5 && $nota <=6 ) {
        echo "Aprobado";

    }else if ($nota >= 7 && $nota <=8 ) {
        echo "Notable";

    } else if ($nota >= 9 && $nota <=10 ) {
        echo "Sobresaliente";
    } else {
        echo "Nota no válida";
    }







?>