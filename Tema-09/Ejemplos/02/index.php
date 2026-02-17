<?php
/*
    ejemplo:9.1
    descripcion: 
*/

require ('fpdf186/fpdf.php');

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('courier', 'B', 10);

$pdf->SetFillColor(192, 192, 192);

$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Hola mundo pdf'), 1, 1, 'C', 1);
$pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'PDF EN 2º DAW'), 1);
$pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'YOEL GOMEZ'), 1, 1);
$pdf->Cell(55, 10, iconv('UTF-8', 'ISO-8859-1', 'ALUMNO 2º DAW'), 1);


$pdf->Output('I', 'listado_articulos.pdf', TRUE); 
?>