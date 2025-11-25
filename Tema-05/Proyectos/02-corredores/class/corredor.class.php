<?php
/*
    Clase Con propiedades extraídas de la c
*/

class class_corredor {
    public $id;
    public $nombre;
    public $apellidos;
    public $ciudad;
    public $fechaNacimiento;
    public $sexo;
    public $email;
    public $dni;
    public $edad;
    public $id_categoria;
    public $id_club;

    public function __construct(
        $id,
        $nombre,
        $apellidos,
        $ciudad,
        $fechaNacimiento,
        $sexo,
        $email,
        $dni,
        $edad,
        $id_categoria,
        $id_club
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->ciudad = $ciudad;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
        $this->email = $email;
        $this->dni = $dni;
        $this->edad = $edad;
        $this->id_categoria = $id_categoria;
        $this->id_club = $id_club;
    }

    public function edad() {
        $fecha_actual = new DateTime();
        $fechaNacimiento = new DateTime($this->fechaNacimiento);
        $edad = $fechaNacimiento->diff($fecha_actual);
        return $edad->y;
    }
}
?>