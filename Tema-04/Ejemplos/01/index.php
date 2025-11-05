<?php
    /*
        Ejemplo 4.1: uso de la clase vehículo
    */

    // Incluir la definición de la clase Vehículo
    include_once 'class/vehiculo.class.php';

    // Crear una instancia de la clase vehículo
    $miVehiculo = new Class_vehiculo();

    // imprimimos la variable para ver su estado inicial
    var_dump($miVehiculo);

    // Establecer valores a los atributos del vehículo
    $miVehiculo->set_matricula("1234-ABC");
    $miVehiculo->set_marca("Toyota");
    $miVehiculo->set_modelo("Corolla");
    $miVehiculo->set_velocidad(0);

    // Mostrar los valores establecidos
    echo "Matrícula: " . $miVehiculo->get_matricula() . "<br>";
    echo "Marca: " . $miVehiculo->get_marca() . "<br>";
    echo "Modelo: " . $miVehiculo->get_modelo() . "<br>";
    echo "Velocidad: " . $miVehiculo->get_velocidad() . "<br>";

    var_dump($miVehiculo);

?>