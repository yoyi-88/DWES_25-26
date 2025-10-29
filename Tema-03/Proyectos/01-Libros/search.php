<?php
/*
    Permite filtrar el array libros mediante una expresión de búsqueda proporcionada por el usuario a través de la URL.
    Luego carga la vista index.view para mostrar los libros.

    Método GET (URL):

        - buscar: Expresion de busqueda para filtrar los libros
        - ejemplo: search.php?expresion=aventuras
        - salida: lista de libros que contienen la expresión en alguno de sus campos
*/

// Incluir librerías
include 'libs/functions.php';

include 'models/search.model.php';

include 'views/index.view.php';


?>


