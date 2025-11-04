<?php
    /*
        Librería de funciones
    */

    // Esta función devolverá un array con los detalles de 6 películas, con índice primario indexado e índice secundario asociativo. 
    // Cada película tendrá los siguientes detalles: id(numérico secuencial), título, año, idioma, director, generos, recaudado (en millones de dólares).
    // Generos será un array indexado con los géneros de la película (mínimo 2, máximo 3 géneros por película).
    function get_tabla_peliculas() {
        $peliculas = [
            [
                'id' => 1,
                'titulo' => 'Inception',
                'anio' => 2010,
                'idioma' => 'Inglés',
                'director' => 'Christopher Nolan',
                'generos' => ['Ciencia Ficción', 'Acción', 'Suspense'],
                'recaudado' => 829.90
            ],
            [
                'id' => 2,
                'titulo' => 'Parásitos',
                'anio' => 2019,
                'idioma' => 'Coreano',
                'director' => 'Bong Joon-ho',
                'generos' => ['Suspense', 'Drama'],
                'recaudado' => 258.71
            ],
            [
                'id' => 3,
                'titulo' => 'El Padrino',
                'anio' => 1972,
                'idioma' => 'Inglés',
                'director' => 'Francis Ford Coppola',
                'generos' => ['Crimen', 'Drama'],
                'recaudado' => 246.12
            ],
            [
                'id' => 4,
                'titulo' => 'El Viaje de Chihiro',
                'anio' => 2001,
                'idioma' => 'Japonés',
                'director' => 'Hayao Miyazaki',
                'generos' => ['Animación', 'Fantasía', 'Aventura'],
                'recaudado' => 355.47
            ],
            [
                'id' => 5,
                'titulo' => 'El Caballero Oscuro',
                'anio' => 2008,
                'idioma' => 'Inglés',
                'director' => 'Christopher Nolan',
                'generos' => ['Acción', 'Crimen', 'Drama'],
                'recaudado' => 1004.56
            ],
            [
                'id' => 6,
                'titulo' => 'Amélie',
                'anio' => 2001,
                'idioma' => 'Francés',
                'director' => 'Jean-Pierre Jeunet',
                'generos' => ['Romance', 'Comedia'],
                'recaudado' => 174.20
            ]
        ];
        return $peliculas;

    }

    // Devuelve el índice de la tabla en la que se encuentra el registro que estamos buscando. 
    //La búsqueda del registro se realiza a partir del id
    function get_indice_pelicula_por_id($peliculas, $id) {
        foreach ($peliculas as $indice => $pelicula) {
            if ($pelicula['id'] == $id) {
                return $indice;
            }
        }
        return null; 
    }


 




?>