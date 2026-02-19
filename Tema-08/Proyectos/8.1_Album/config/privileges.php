<?php

    /*
        Definimos los privilegios de la aplicación

        Recordamos los perfiles:
        - ADMIN: Administrador
        - EDITOR: Editor
        - REGISTRADO: Registrado

        Recordamos los controladores o recursos:
        - 1: album

        Los privilegios son:
        - 1: render
        - 2: new
        - 3: edit
        - 4: delete
        - 5: show
        - 6: order
        - 7: search

        Los perfiles se asignarán mediante un array asociativo, 
        donde la clave principal se corresponde con el controlador 
        la clave secundaria con el  método.

        $GLOBALS['album']['main] = [ADMIN, EDITOR, REGISTRADO];

        Se asignan los perfiles que tienen acceso a un determinado método del controlador album.

    */ 

    // Definimos constantes para los perfiles
    define('ADMIN', 1);
    define('EDITOR', 2);
    define('REGISTRADO', 3);
    
    // Privilegios para el controlador album
    $GLOBALS['album']['render'] = [ADMIN, EDITOR, REGISTRADO];
    $GLOBALS['album']['new'] = [ADMIN, EDITOR];
    $GLOBALS['album']['edit'] = [ADMIN, EDITOR];
    $GLOBALS['album']['delete'] = [ADMIN];
    $GLOBALS['album']['show'] = [ADMIN, EDITOR, REGISTRADO];
    $GLOBALS['album']['search'] = [ADMIN, EDITOR, REGISTRADO];
    $GLOBALS['album']['order'] = [ADMIN, EDITOR, REGISTRADO];

    // Privilegios para el controlador User
    $GLOBALS['user']['render'] = [ADMIN];
    $GLOBALS['user']['new'] = [ADMIN];
    $GLOBALS['user']['edit'] = [ADMIN];
    $GLOBALS['user']['delete'] = [ADMIN];
    $GLOBALS['user']['show'] = [ADMIN];
    $GLOBALS['user']['search'] = [ADMIN];
    $GLOBALS['user']['order'] = [ADMIN];