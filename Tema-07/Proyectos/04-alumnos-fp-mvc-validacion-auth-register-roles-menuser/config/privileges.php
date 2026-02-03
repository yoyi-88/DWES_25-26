<?php

    /*
        Definimos los privilegios de la aplicación

        Recordamos los perfiles:
        - 1: Administrador
        - 2: Editor
        - 3: Registrado

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

        Los perfiles se asignarán mediante un array asociativo, 
        donde la clave principal se corresponde con el controlador 
        la clave secundaria con el  método.

        $GLOBALS['alumno']['main] = [1, 2, 3];

        Se asignan los perfiles que tienen acceso a un determinado método del controlador alumno.

    */ 
    $GLOBALS['alumno']['render'] = [1, 2, 3];
    $GLOBALS['alumno']['new'] = [1, 2];
    $GLOBALS['alumno']['edit'] = [1, 2];
    $GLOBALS['alumno']['delete'] = [1];
    $GLOBALS['alumno']['show'] = [1, 2, 3];
    $GLOBALS['alumno']['search'] = [1, 2, 3];
    $GLOBALS['alumno']['order'] = [1, 2, 3];