<?php

namespace Controllers;

use MVC\Router;

class DisponibilidadController {
    public static function estadistica(Router $router){
        $router->render('disponibilidad/estadistica', []);
    }

    public static function disponibilidadAPI(){
        $sql = "SELECT 
        disponibilidad.habitacion_disponibilidad,
        NVL(COUNT(*), 0) AS cantidad
    FROM 
        (SELECT 'disponible' AS habitacion_disponibilidad
         UNION
         SELECT 'en_uso'
         UNION
         SELECT 'limpieza') disponibilidad
    LEFT JOIN 
        habitaciones ON disponibilidad.habitacion_disponibilidad = habitaciones.habitacion_disponibilidad
    GROUP BY 
        disponibilidad.habitacion_disponibilidad";
    }
    

}