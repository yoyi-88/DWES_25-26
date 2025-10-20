<?php
/*




*/

//Datos a introducir
$velIn = $_POST["velIn"];
$angulo = $_POST["angulo"];

//calculos
$angRad = $velIn * (pi() / 180);
$v0x = $velIn * cos($angRad);
$v0y = $velIn * sin($angRad);





?>