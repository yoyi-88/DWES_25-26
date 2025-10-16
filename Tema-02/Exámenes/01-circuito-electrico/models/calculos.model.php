<?php

/*



*/

// Datos de entrada
$tension = $_POST["tension"];
$resElec = $_POST["resElec"];
$tiempo = $_POST["tiempo"];


// Calculos
$intCorr = $tension / $resElec;
$potElec = $tension * $intCorr;
$enXSeg = $potElec * $tiempo;
$dosRes = $resElec / 2;





?>