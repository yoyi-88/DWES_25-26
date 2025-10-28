<?php
/*
    Recibe un parametro id desde la url y elimina el array correspondiente del array $libros.
    Luego carga la vista index.view para mostrar los libros.

    Método GET (URL):

        - id: identificador del libro a eliminar
        - ejemplo: delete.php?id=3
*/

// Incluir librerías
include 'libs/functions.php';

include 'models/delete.model.php';

include 'views/index.view.php';


?>


