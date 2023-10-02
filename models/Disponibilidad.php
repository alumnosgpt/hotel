<?php

namespace Model;

class Disponibilidad extends ActiveRecord{
    public static $tabla = 'habitaciones';
    public static $columnasDB = ['habitacion_numero','habitacion_tipo','habitacion_descripcion','habitacion_tarifa','habitacion_disponibilidad','habitacion_situacion'];
    public static $idTabla = 'habitacion_id';

    public $habitacion_id;
    public $habitacion_numero;
    public $habitacion_tipo;
    public $habitacion_descripcion;
    public $habitacion_tarifa;
    public $habitacion_disponibilidad;
    public $habitacion_situacion;

    public function __construct($args =[])
    {
        $this->habitacion_id = $args['habitacion_id'] ?? null;
        $this->habitacion_numero = $args['habitacion_numero'] ?? '';
        $this->habitacion_tipo = $args['habitacion_tipo'] ?? '';
        $this->habitacion_descripcion = $args['habitacion_descripcion'] ?? '';
        $this->habitacion_tarifa = $args['habitacion_tarifa'] ?? '';
        $this->habitacion_disponibilidad = $args['habitacion_disponibilidad'] ?? '';
        $this->habitacion_situacion = $args['habitacion_situacion'] ?? '1';
    }

}   