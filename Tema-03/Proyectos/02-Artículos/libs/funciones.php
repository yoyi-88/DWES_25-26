<?php
    /*
        Descripción: Biblioteca de funciones del proyecto
        -get_tabla_artículos(): Devuelve un array con los artículos disponibles
        -get_tabla_categorías(): Devuelve un array con las categorías disponibles
    */

    // fución que devuelve un array de categorías
    function get_tabla_categorias() {

        $categorias = [
            ["id" => 1, "nombre" => "Electrónica"],
            ["id" => 2, "nombre" => "Almacenamiento"],
            ["id" => 3, "nombre" => "Portátiles"],
            ["id" => 4, "nombre" => "Accesorios"]
        ];

        return $categorias;
    }
    // función que devuelve un array de artículos
    function get_tabla_articulos() {
        $articulos = [
            [
                'id' => 1,
                'descripcion' => "Portátil HP 15.6",
                'modelo' => 'hP-15DW',
                'categoria_id' => 3,
                'unidades' => 10,
                'precio' => 649.99
            ],
            [
                'id' => 2,
                'descripcion' => 'Disco Duro Externo 1TB',
                'modelo' => 'Seagate-1TB',
                'categoria_id' => 2,
                'unidades' => 25,
                'precio' => 59.99
            ],
            [
                'id' => 3,
                'descripcion' => 'Ratón Inalámbrico Logitech',
                'modelo' => 'Logitech-M185',
                'categoria_id' => 4,
                'unidades' => 50,
                'precio' => 14.99
            ],
            [
                'id' => 4,
                'descripcion' => 'Smartphone Samsung Galaxy S21',
                'modelo' => 'Samsung-S21',
                'categoria_id' => 1,
                'unidades' => 15,
                'precio' => 799.99
            ]

        ];
        return $articulos;

    }

?>