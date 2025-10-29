<?php
    /*
        Descripción: Actualiza los detalles de un libro en el array de libros
    */


    // Obtener la expresion de busqueda desde la url
    $expresion = $_GET["expresion"] ?? null;

    $libros = get_tabla_libros();



    if ($expresion) {

        // Creo array vacio para almacenar libros que coinciden con la busqueda
        $aux = [];

        // Recorro array de libros y compruebo los campos
        foreach($libros as $libro) {

            if(array_search($expresion, $libro) !== false) {
                // Si alguno de los campos coincide, añado el libro al array auxiliar
                $aux[] = $libro;
            }

        }
    }

    // Asigno el array auxiliar al array de libros
    $libros = $aux;



?>
