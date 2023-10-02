<?php

namespace Controllers;

use Exception;
use Model\Disponibilidad;
use MVC\Router;

class DisponibilidadController {
    public static function estadistica(Router $router){
        $router->render('disponibilidad/estadistica', []);
    }

    public static function estadisticas(){

        $datos= Disponibilidad::fetchArray(" SELECT 
        CASE opciones.habitacion_disponibilidad
            WHEN 1 THEN 'habitacion disponible'
            WHEN 2 THEN 'habitacion reservado'
            WHEN 3 THEN 'habitacion en mantenimiento'
            WHEN 4 THEN 'habitacion privada'
            ELSE 'estado no reconocido'
        END AS disponibilidad,
        NVL(COUNT(habitaciones.habitacion_id), 0) AS cantidad
    FROM 
        (SELECT 1 AS habitacion_disponibilidad
         UNION
         SELECT 2
         UNION
         SELECT 3
         UNION
         SELECT 4) opciones
    LEFT JOIN 
        habitaciones ON opciones.habitacion_disponibilidad = habitaciones.habitacion_disponibilidad
    GROUP BY 
        opciones.habitacion_disponibilidad;
                     
    ");

    echo json_encode($datos);
    exit;
       
    }
    
    
   

    public static function buscarAPI() {
        $habitacion_disponibilidad = $_GET['habitacion_disponibilidad'] ?? null;
    
        if ($habitacion_disponibilidad !== null) {
            $sql = "SELECT
                        CASE 
                            WHEN habitacion_disponibilidad = 1 THEN 'Disponibles'
                            WHEN habitacion_disponibilidad = 2 THEN 'Ocupadas'
                            WHEN habitacion_disponibilidad = 3 THEN 'En Limpieza'
                            ELSE 'Estado Desconocido'
                        END AS estado_disponibilidad,
                        COUNT(*) AS cantidad
                    FROM habitaciones 
                    WHERE habitacion_situacion = 1 AND habitacion_disponibilidad = $habitacion_disponibilidad
                    GROUP BY habitacion_disponibilidad";
        } else {
            $sql = "SELECT
                        CASE 
                            WHEN habitacion_disponibilidad = 1 THEN 'Disponibles'
                            WHEN habitacion_disponibilidad = 2 THEN 'Ocupadas'
                            WHEN habitacion_disponibilidad = 3 THEN 'En Limpieza'
                            ELSE 'Estado Desconocido'
                        END AS estado_disponibilidad,
                        COUNT(*) AS cantidad
                    FROM habitaciones 
                    WHERE habitacion_situacion = 1
                    GROUP BY habitacion_disponibilidad";
        }
    
        try {
            $disponibilidad = Disponibilidad::fetchArray($sql);
            echo json_encode($disponibilidad);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
  
}
