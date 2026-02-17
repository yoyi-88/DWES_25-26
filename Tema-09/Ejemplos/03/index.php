<?php
/*
    ejemplo:9.1
    descripcion: 
*/

// Generar un array de datos 40 filas con las columnas: 
// - id
// - 'nombre'
// - 'categoria'
// - precio 

$productos = [
    ['id' => 1,  'nombre' => 'Teclado Mecánico', 'categoria' => 'Periféricos', 'precio' => 85.50],
    ['id' => 2,  'nombre' => 'Ratón Ergonómico', 'categoria' => 'Periféricos', 'precio' => 42.00],
    ['id' => 3,  'nombre' => 'Monitor 27 Pulgadas', 'categoria' => 'Imagen', 'precio' => 299.99],
    ['id' => 4,  'nombre' => 'Cable HDMI 2.1', 'categoria' => 'Accesorios', 'precio' => 15.00],
    ['id' => 5,  'nombre' => 'Auriculares Pro', 'categoria' => 'Audio', 'precio' => 120.00],
    ['id' => 6,  'nombre' => 'Alfombrilla XL', 'categoria' => 'Periféricos', 'precio' => 25.50],
    ['id' => 7,  'nombre' => 'Webcam 4K', 'categoria' => 'Imagen', 'precio' => 89.00],
    ['id' => 8,  'nombre' => 'Micrófono USB', 'categoria' => 'Audio', 'precio' => 75.25],
    ['id' => 9,  'nombre' => 'Silla Gaming', 'categoria' => 'Mobiliario', 'precio' => 210.00],
    ['id' => 10, 'nombre' => 'Escritorio Elevable', 'categoria' => 'Mobiliario', 'precio' => 350.00],
    ['id' => 11, 'nombre' => 'Disco Duro 2TB', 'categoria' => 'Almacenamiento', 'precio' => 65.00],
    ['id' => 12, 'nombre' => 'Memoria RAM 16GB', 'categoria' => 'Componentes', 'precio' => 80.00],
    ['id' => 13, 'nombre' => 'Tarjeta Gráfica', 'categoria' => 'Componentes', 'precio' => 540.00],
    ['id' => 14, 'nombre' => 'Procesador i7', 'categoria' => 'Componentes', 'precio' => 320.00],
    ['id' => 15, 'nombre' => 'Placa Base ATX', 'categoria' => 'Componentes', 'precio' => 150.00],
    ['id' => 16, 'nombre' => 'Fuente de Alimentación', 'categoria' => 'Componentes', 'precio' => 95.00],
    ['id' => 17, 'nombre' => 'Ventilador RGB', 'categoria' => 'Componentes', 'precio' => 18.00],
    ['id' => 18, 'nombre' => 'Pasta Térmica', 'categoria' => 'Accesorios', 'precio' => 8.50],
    ['id' => 19, 'nombre' => 'Caja Semitorre', 'categoria' => 'Componentes', 'precio' => 70.00],
    ['id' => 20, 'nombre' => 'Adaptador Wi-Fi', 'categoria' => 'Redes', 'precio' => 22.00],
    ['id' => 21, 'nombre' => 'Router Dual Band', 'categoria' => 'Redes', 'precio' => 45.00],
    ['id' => 22, 'nombre' => 'Switch 8 Puertos', 'categoria' => 'Redes', 'precio' => 30.00],
    ['id' => 23, 'nombre' => 'Cable Red 5m', 'categoria' => 'Redes', 'precio' => 12.00],
    ['id' => 24, 'nombre' => 'Altavoces 2.1', 'categoria' => 'Audio', 'precio' => 55.00],
    ['id' => 25, 'nombre' => 'Smartwatch Sport', 'categoria' => 'Gadgets', 'precio' => 130.00],
    ['id' => 26, 'nombre' => 'Tablet 10 Pulgadas', 'categoria' => 'Móviles', 'precio' => 199.00],
    ['id' => 27, 'nombre' => 'Funda Portátil', 'categoria' => 'Accesorios', 'precio' => 25.00],
    ['id' => 28, 'nombre' => 'Luz LED Escritorio', 'categoria' => 'Hogar', 'precio' => 35.00],
    ['id' => 29, 'nombre' => 'Cargador Rápido', 'categoria' => 'Accesorios', 'precio' => 19.99],
    ['id' => 30, 'nombre' => 'Power Bank 20k', 'categoria' => 'Accesorios', 'precio' => 40.00],
    ['id' => 31, 'nombre' => 'Hub USB-C', 'categoria' => 'Accesorios', 'precio' => 28.00],
    ['id' => 32, 'nombre' => 'Impresora Láser', 'categoria' => 'Oficina', 'precio' => 145.00],
    ['id' => 33, 'nombre' => 'Escáner de Documentos', 'categoria' => 'Oficina', 'precio' => 90.00],
    ['id' => 34, 'nombre' => 'Soporte Monitor', 'categoria' => 'Mobiliario', 'precio' => 45.00],
    ['id' => 35, 'nombre' => 'Lector Tarjetas', 'categoria' => 'Accesorios', 'precio' => 15.50],
    ['id' => 36, 'nombre' => 'Auriculares Bluetooth', 'categoria' => 'Audio', 'precio' => 60.00],
    ['id' => 37, 'nombre' => 'Teclado Numérico', 'categoria' => 'Periféricos', 'precio' => 20.00],
    ['id' => 38, 'nombre' => 'Mando Gaming', 'categoria' => 'Periféricos', 'precio' => 50.00],
    ['id' => 39, 'nombre' => 'Disco Externo SSD', 'categoria' => 'Almacenamiento', 'precio' => 110.00],
    ['id' => 40, 'nombre' => 'Protector Pantalla', 'categoria' => 'Accesorios', 'precio' => 10.00],
];

// Creamos nuestra clase pdf personalizada, heredando de pdf
class PDF extends FPDF {
    // Método para el encabezado del pdf
    function Header() {
        //Arial bold 15
        $this->SetFont('Courier','B',10);
        //Título centrado
        $this->Cell(60,10,'Titulo del archivo',1,0,'C');
        //Salto de línea
        $this->Ln(20);
    }
}

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