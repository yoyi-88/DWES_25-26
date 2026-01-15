<?php

class class_libro {
    public $id;
    public $titulo;
    public $autor_id;
    public $editorial_id;
    public $precio_venta;
    public $stock;
    public $temas; 


    public function __construct(
        $id = null,
        $titulo = null,
        $autor_id = null,
        $editorial_id = null,
        $precio_venta = null,
        $stock = null,
        $temas = null 
    )
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor_id = $autor_id;
        $this->editorial_id = $editorial_id;
        $this->precio_venta = $precio_venta;
        $this->stock = $stock;
        $this->temas = $temas; 
    }

}

?>