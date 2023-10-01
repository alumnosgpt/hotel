<?php

namespace Model;

class Factura extends ActiveRecord
{
    public static $tabla = 'factura';
    public static $columnasDB = ['factura_reserva_id', 'factura_fecha', 'factura_total', 'factura_nit_cliente', 'factura_direccion', 'factura_cantidad_dias', 'factura_situacion'];
    public static $idTabla = 'factura_id';

    public $factura_id;
    public $factura_reserva_id;
    public $factura_fecha;
    public $factura_total;
    public $factura_nit_cliente;
    public $factura_direccion;
    public $factura_cantidad_dias;
    public $factura_situacion;

    public function __construct($args = [])
    {
        $this->factura_id = $args['factura_id'] ?? null;
        $this->factura_reserva_id = $args['factura_reserva_id'] ?? null;
        $this->factura_fecha = $args['factura_fecha'] ?? '';
        $this->factura_total = $args['factura_total'] ?? 0.00;
        $this->factura_nit_cliente = $args['factura_nit_cliente'] ?? '';
        $this->factura_direccion = $args['factura_direccion'] ?? '';
        $this->factura_cantidad_dias = $args['factura_cantidad_dias'] ?? 0;
        $this->factura_situacion = $args['factura_situacion'] ?? '1';
    }
}
