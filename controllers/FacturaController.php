<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;
use Model\Factura;
use Exception;

class FacturaController
{
    public static function index(Router $router)
    {
        // Aquí puedes cargar datos adicionales si es necesario
        $router->render('factura/index', [
            'clientes' => [],  // Reemplaza con lógica para obtener clientes
            'tiposHabitacion' => []  // Reemplaza con lógica para obtener tipos de habitación
        ]);
    }

    public static function buscarAPI()
    {
        $clienteId = $_GET['cliente'] ?? null;
        $tipoHabitacionId = $_GET['tipo_habitacion'] ?? null;

        // Si los IDs son nulos, no realizar la búsqueda
        if ($clienteId === null || $tipoHabitacionId === null) {
            echo json_encode([
                'error' => true,
                'message' => 'Parámetros de búsqueda incorrectos'
            ]);
            return;
        }

        // Construir la consulta SQL utilizando los IDs de cliente y tipo de habitación
        $sql = "
            SELECT
                f.factura_fecha AS fecha,
                f.factura_total AS total
                -- Otros campos según sea necesario
            FROM
                factura f
                INNER JOIN reservas r ON f.factura_reserva_id = r.reserva_id
                INNER JOIN habitaciones h ON r.reserva_habitacion_id = h.habitacion_id
            WHERE
                r.reserva_cliente_id = :cliente_id
                AND h.habitacion_tipo = :tipo_habitacion";

        try {
            // Ejecutar la consulta SQL para obtener datos de facturas según los parámetros de búsqueda.
            $facturas = Factura::fetchArray($sql, [
                ':cliente_id' => $clienteId,
                ':tipo_habitacion' => $tipoHabitacionId
            ]);

            echo json_encode($facturas);
        } catch (Exception $e) {
            echo json_encode([
                'error' => true,
                'message' => 'Ocurrió un error al buscar las facturas',
                'details' => $e->getMessage()
            ]);
        }
    }
}
