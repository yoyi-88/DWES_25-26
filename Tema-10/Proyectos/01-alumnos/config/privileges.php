<?php

    /*
        Definimos los privilegios de la aplicación

        Recordamos los perfiles:
        - ADMIN: Administrador
        - EDITOR: Editor
        - REGISTRADO: Registrado

        Recordamos los controladores o recursos:
        - 1: Alumno

        Los privilegios son:
        - 1: render
        - 2: new
        - 3: edit
        - 4: delete
        - 5: show
        - 6: order
        - 7: search
        - 8: export
        - 9: import

        Los perfiles se asignarán mediante un array asociativo, 
        donde la clave principal se corresponde con el controlador 
        la clave secundaria con el  método.

        $GLOBALS['alumno']['main] = [ADMIN, EDITOR, REGISTRADO];

        Se asignan los perfiles que tienen acceso a un determinado método del controlador alumno.

    */ 

    // Definimos constantes para los perfiles
    define('ADMIN', 1);
    define('EDITOR', 2);
    define('REGISTRADO', 3);
    
    // Privilegios para el controlador Alumno
    $GLOBALS['alumno']['render'] = [ADMIN, EDITOR, REGISTRADO];
    $GLOBALS['alumno']['new'] = [ADMIN, EDITOR];
    $GLOBALS['alumno']['edit'] = [ADMIN, EDITOR];
    $GLOBALS['alumno']['delete'] = [ADMIN];
    $GLOBALS['alumno']['show'] = [ADMIN, EDITOR, REGISTRADO];
    $GLOBALS['alumno']['search'] = [ADMIN, EDITOR, REGISTRADO];
    $GLOBALS['alumno']['order'] = [ADMIN, EDITOR, REGISTRADO];
    $GLOBALS['alumno']['export'] = [ADMIN, EDITOR];
    $GLOBALS['alumno']['import'] = [ADMIN];

    // Privilegios para el controlador User
    $GLOBALS['user']['render'] = [ADMIN];
    $GLOBALS['user']['new'] = [ADMIN];
    $GLOBALS['user']['edit'] = [ADMIN];
    $GLOBALS['user']['delete'] = [ADMIN];
    $GLOBALS['user']['show'] = [ADMIN];
    $GLOBALS['user']['search'] = [ADMIN];
    $GLOBALS['user']['order'] = [ADMIN];