<?php

/*
    clase: class_libro
    descripción: clase para gestionar los libros

*/

class class_libro {
    public $id;
    public $isbn;
    public $ean;
    public $titulo;
    public $autor_id;
    public $precio_coste;
    public $precio_venta;
    public $stock;
    public $stock_minimo;
    public $stock_maximo;
    public $fecha_alta;

public function __construct(
    $id = null,
    $isbn = null,
    $ean= null,
    $titulo = null,
    $autor_id= null,
    $precio_coste = null,
    $precio_venta = null,
    $stock = null,
    $stock_minimo = null,
    $stock_maximo = null,
    $fecha_alta = null
)

{
    $this->id = $id;
    $this->isbn = $isbn;
    $this->ean = $ean;
    $this->titulo = $titulo;
    $this->autor_id = $autor_id;
    $this->precio_coste = $precio_coste;
    $this->precio_venta = $precio_venta;
    $this->stock = $stock;
    $this->stock_minimo = $stock_minimo;
    $this->stock_maximo = $stock_maximo;
    $this->fecha_alta = $fecha_alta;

}

}

