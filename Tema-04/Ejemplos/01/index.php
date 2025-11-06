<?php
    /*
        Ejemplo 4.1: Definición de una clase Vehículo en PHP
        Autor: Javier Rodríguez
        Fecha: 05/11/2025
    */
    
    // Incluimos la definición de la clase Vehículo
    include_once "class/vehiculo.class.php";

    // Crear una instancia de la clase Vehículo
    $miVehiculo = new Class_vehiculo();

    // OPCIONAL. Comprobar que se ha creado:
    var_dump($miVehiculo);

    // Establecer valores a los atributos:
    $miVehiculo->set_matricula("1234-ABC");
    $miVehiculo->set_marca("Toyota");
    $miVehiculo->set_modelo("Corolla");
    $miVehiculo->set_velocidad(100);

    // Mostrar los valores de los atributos:
    $miVehiculo->get_matricula();
    $miVehiculo->get_marca();
    $miVehiculo->get_modelo();
    $miVehiculo->get_velocidad();

    
?>