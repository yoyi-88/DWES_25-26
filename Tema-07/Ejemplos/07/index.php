<?php
    /*
        ejemplo: 7.7
        descripción: 
    */


    // Creamos cookie
    setcookie('nombre', 'Juan Yoyi', time() + 3600);
    setcookie('apellidos', 'garcia lopez', time() + 3600);

    echo "Cookies creadas<br>";
    print_r($_COOKIE);


?>