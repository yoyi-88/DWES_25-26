<?php

class class_libro {
    public $id;
    public $titulo;
    public $autor_id;
    public $editorial_id;
    public $generos;
    public $stock;
    public $precio_venta;

    public function __construct(
        $id = null,
        $titulo = null,
        $autor_id = null,
        $editorial_id = null,
        $generos = null,
        $stock = null,
        $precio_venta = null
    )
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor_id = $autor_id;
        $this->editorial_id = $editorial_id;
        $this->generos = $generos;
        $this->stock = $stock;
        $this->precio_venta = $precio_venta;
    }

}

?>