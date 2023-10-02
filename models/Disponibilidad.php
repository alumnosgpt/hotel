<?php

namespace Model;

class Habitacion extends ActiveRecord
{
    public static $tabla = 'habitaciones';
    public static $columnasDB = ['habitacion_numero', 'habitacion_tipo', 'habitacion_descripcion', 'habitacion_tarifa', 'habitacion_disponibilidad'];
    public static $idTabla = 'habitacion_id';

    public $habitacion_id;
    public $habitacion_numero;
    public $habitacion_tipo;
    public $habitacion_descripcion;
    public $habitacion_tarifa;
    public $habitacion_disponibilidad;

    public function __construct($args = [])
    {
        $this->habitacion_id = $args['habitacion_id'] ?? null;
        $this->habitacion_numero = $args['habitacion_numero'] ?? 0;
        $this->habitacion_tipo = $args['habitacion_tipo'] ?? '';
        $this->habitacion_descripcion = $args['habitacion_descripcion'] ?? '';
        $this->habitacion_tarifa = $args['habitacion_tarifa'] ?? 0.00;
        $this->habitacion_disponibilidad = $args['habitacion_disponibilidad'] ?? 'disponible';
    }
}
