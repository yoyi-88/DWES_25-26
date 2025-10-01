<?php
    /*
    * Ejemplo 2.6
    * Autor: yoyi
    * Descripción: Uso de variables no definidas
    */

    
    $var1 = 100; 
    $var3 = 200 + $var2; 
    echo $var3; // muestra 200
    $var3 = 100 * $var2;  
    echo $var3; //muestra 0 

?>