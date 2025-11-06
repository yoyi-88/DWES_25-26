<?php
    /*
        Ejemplo 4.4: Herencia (subclase sin constructor)
        Autor: Javier Rodríguez
        Fecha: 05/11/2025
    */
    
    // CONTROLADOR: Todos los includes
    // 1. Incluimos la clase Vehículo
    include_once "class/vehiculo.class.php";

    // 2. Incluimos la clase Coche
    include_once "class/coche.class.php";

    // Crear una instancia de la clase Vehículo
    $miVehiculo = new Class_coche();

    // OPCIONAL. Comprobar que se ha creado:
    var_dump($miVehiculo);

    // Crear otra instancia de la clase Coche, pasando parámetros al constructor.
    // Como la subclase no tiene constructor, se usa el de la superclase y luego le asignamos el número de puertas.
    $otroCoche = new Class_coche('1234-ABC', 'Toyota', 'Corolla', 120);
    $otroCoche->set_numPuertas(4);

    var_dump($otroCoche);

    
    
?>