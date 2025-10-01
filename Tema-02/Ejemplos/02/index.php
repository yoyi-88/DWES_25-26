<?php

/*
Ejemplo: 2.2
Fecha: 2024-09-17
Descripción: Ejemplo de uso delimitador string ",""
*/

    $nombre = "Yoël";
    $edad = 19;

    echo "<p>Hola, me llamo $nombre y tengo $edad años</p>"; // Con comillas dobles, interpreta variables
    echo '<p>Hola, me llamo $nombre y tengo $edad años</p>'; // Con comillas simples, no interpreta variables
    echo '<b>Hola, me llamo $nombre y tengo $edad años</b>'; // Con b pone el texto en negrita
    echo '<p>Hola, me llamo ' . $nombre . ' y tengo ' . $edad . ' años</p>'; // Concatenando con . aunque usemos comillas simples
    // Si queremos expresar unicamente texto simple usamos comillas simples, ya que estas no interpretan variables y son mas rapidas que las dobles
?>