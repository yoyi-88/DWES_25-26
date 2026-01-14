<?php
    /*
        ejemplo: 7.8
        descripción: número de visitas utilizando cookies
    */


    if (isset($_COOKIE['visitas'])) {
        $visitas = $_COOKIE['visitas'] + 1;
    } else {
        $visitas = 1;
    }

    setcookie('visitas', $visitas, time() + 3600); 

    echo "Número de visitas: " . $visitas;

?>