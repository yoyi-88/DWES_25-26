<?php
/*
    Funciones reutilizables para la gestion de libros.
*/

// Función para obtener el array de libros (simulando base de datos (select * from))
function get_tabla_libros() {
    $tabla = [

    [
        'id' => 1,
        'titulo' => "cien años de soledad",
        'autor' => "Gabriel garcia marquez",
        'editorial' => "Editorial Sudamericana",
        'genero' => "realismo magico",
        'precio' => 19.99
        
        ],
        [
        'id' => 2,
        'titulo' => "jua pi",
        'autor' => "elchino hola",
        'editorial' => "Editorial Ejemplo",
        'genero' => "aventura",
        'precio' => 10.99
        
        ],
        [
        'id' => 3,
        'titulo' => "El hobbit",
        'autor' => "J.R.R. Tolkien",
        'editorial' => "Minotauro",
        'genero' => "fantasía",
        'precio' => 14.50
        
        ],
        [
        'id' => 4,
        'titulo' => "1984",
        'autor' => "George Orwell",
        'editorial' => "Editorial Debate",
        'genero' => "distopía",
        'precio' => 12.00
        
        ],
        [
        'id' => 5,
        'titulo' => "Don Quijote de la Mancha",
        'autor' => "Miguel de Cervantes",
        'editorial' => "Editorial Cátedra",
        'genero' => "clásico",
        'precio' => 9.99
        
        ],
        [
        'id' => 6,
        'titulo' => "La Sombra del Viento",
        'autor' => "Carlos Ruiz Zafón",
        'editorial' => "Editorial Planeta",
        'genero' => "misterio",
        'precio' => 11.75
        
        ],
        [
        'id' => 7,
        'titulo' => "Crimen y castigo",
        'autor' => "Fiódor Dostoyevski",
        'editorial' => "Editorial Acantilado",
        'genero' => "drama",
        'precio' => 13.20
        
        ],
        [
        'id' => 8,
        'titulo' => "Rayuela",
        'autor' => "Julio Cortázar",
        'editorial' => "Anagrama",
        'genero' => "experimental",
        'precio' => 10.50
        
    ]

];
    return $tabla;
}

function get_indice_libro_por_id($libros, $id)
{
    foreach ($libros as $indice => $libro) {
        if ($libro['id'] == $id) {
            return $indice;
        }
    }
    return null; // Retorna null si no se encuentra el número
}

?>