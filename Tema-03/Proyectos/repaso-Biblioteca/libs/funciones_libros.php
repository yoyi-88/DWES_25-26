<?php
    /*
        Librería en la que guardaremos todas las funciones del proyecto
    */

    // get_tabla_libros() - devolverá una tabla (array) con al menos 5 libros compuestos por id, titulo, autor, genero, copias(unidades disponibles), publicacion.
    function get_tabla_libros()
    {
        $libros = [
            ['id' => 1, 'titulo' => 'Cien años de soledad', 'autor' => 'Gabriel García Márquez', 'genero' => 'Ficción', 'copias' => 3, 'publicacion' => 1967],
            ['id' => 2, 'titulo' => 'Don Quijote de la Mancha', 'autor' => 'Miguel de Cervantes', 'genero' => 'Clásico', 'copias' => 5, 'publicacion' => 1605],
            ['id' => 3, 'titulo' => 'La sombra del viento', 'autor' => 'Carlos Ruiz Zafón', 'genero' => 'Ficción', 'copias' => 4, 'publicacion' => 2001],
            ['id' => 4, 'titulo' => '1984', 'autor' => 'George Orwell', 'genero' => 'Ciencia Ficción', 'copias' => 2, 'publicacion' => 1949],
            ['id' => 5, 'titulo' => 'El amor en los tiempos del cólera', 'autor' => 'Gabriel García Márquez', 'genero' => 'Ficción', 'copias' => 1, 'publicacion' => 1985],
        ];
        return $libros;
    }
    // get_tabla_generos() - devolverá una tabla con todos los géneros utilizados (Novela, Ensayo, Poesía, Biografía, Ciencia Ficción).
    function get_tabla_generos()
    {
        $generos = [
            ['genero' => 'novela'],
            ['genero' => 'ensayo'],
            ['genero' => 'poesía'],
            ['genero' => 'biografía'],
            ['genero' => 'ciencia ficcion']

        ];
        return $generos;
    }

    // get_indice_libro_por_id() - devolverá el índice del libro en la tabla libros a partir de su id.
    function get_indice_libro_por_id($libros, $id)
    {
        foreach ($libros as $indice => $libro) {
            if ($libro['id'] == $id) {
                return $indice;
            }
        }
        return null; // Si no se encuentra el libro
    }
?>
