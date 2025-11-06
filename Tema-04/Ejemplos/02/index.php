<?php
    /*
        Ejemplo 4.2: Definición de una clase Producto sin encapsulamiento 
                     y con constructor por defecto.
        Autor: Javier Rodríguez
        Fecha: 05/11/2025
    */
    
    // Incluimos la definición de la clase Vehículo
    include_once "class/producto.class.php";

    // Crear una instancia de la clase Vehículo
    $miProducto = new Class_producto('tablet', 250.00, 10);

    // Creamos una instancia de la clase Vehículo con valores por defecto:
    $productoPorDefecto = new Class_producto();

    // Asignar valores a los atributos directamente (sin encapsulamiento, al ser públicos):
    $productoPorDefecto->nombre = "Smartphone";
    $productoPorDefecto->precio = 500.00;
    $productoPorDefecto->cantidad = 5;

    // Mostrar el contenido del objeto:
    echo 'Nombre: ' . $productoPorDefecto->nombre . '\n';
    echo 'Precio: ' . $productoPorDefecto->precio . '\n';
    echo 'Cantidad: ' . $productoPorDefecto->cantidad . '\n';

    // OPCIONAL. Comprobar que se ha creado:
    var_dump($miProducto);
    var_dump($productoPorDefecto);

?>