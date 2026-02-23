<?php
// Ajusta la ruta a la carpeta donde tengas fpdf dentro de tu proyecto
require_once 'libs/fpdf186/fpdf.php'; 

class pdf_libros extends FPDF {

    // Se ejecuta automáticamente al crear una nueva página
    function Header() {
        $this->SetFont('Arial', '', 10);
        
        // Encabezado 
        // Dado que el ancho total de A4 es aprox 190mm (con márgenes). Dividimos en 3 partes de 63mm
        $this->Cell(63, 10, 'Geslibros 1.0', 'B', 0, 'L'); // 'B' dibuja el borde inferior
        // 
        $this->Cell(64, 10, iconv('UTF-8', 'ISO-8859-1', 'Yoël Gómez Benítez'), 'B', 0, 'C'); 
        $this->Cell(63, 10, '2DAW 25/26', 'B', 1, 'R'); // '1' hace el salto de línea
        
        $this->Ln(5); // Espaciado

        // Llamada a la cabecera
        // Al ponerlo en el Header, garantizamos que imprima la cabecera en cada página nueva
        $this->cabecera();
    }

    // Se ejecuta automáticamente al final de la página
    function Footer() {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        
        // Número de página centrado con borde superior ('T')
        // {nb} es un comodín de FPDF para el total de páginas (requiere AliasNbPages)
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }

    // Título principal del informe
    function titulo() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, 'Informe: Listado de Libros', 0, 1, 'L');
        $this->Cell(0, 8, 'Fecha: ' . date('d/m/Y H:i:s'), 0, 1, 'L');
        $this->Ln(5);
    }

    // Encabezado de las columnas (Fondo sombreado y borde inferior)
    function cabecera() {
        $this->SetFillColor(200, 200, 200); // Gris claro para el fondo
        $this->SetFont('Arial', 'B', 10);
        
        // Los anchos suman 190 para encajar en el A4
        $this->Cell(10, 10, 'Id', 'B', 0, 'C', true);
        $this->Cell(55, 10, iconv('UTF-8', 'ISO-8859-1', 'Título'), 'B', 0, 'L', true);
        $this->Cell(35, 10, 'Autor', 'B', 0, 'L', true);
        $this->Cell(30, 10, 'Editorial', 'B', 0, 'L', true);
        $this->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', 'Géneros'), 'B', 0, 'L', true);
        $this->Cell(15, 10, 'Stock', 'B', 0, 'C', true);
        $this->Cell(15, 10, 'Precio', 'B', 1, 'R', true); // El '1' al final hace el salto de línea
    
    }
}
?>