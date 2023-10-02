<?php 
require_once __DIR__ . '/../includes/app.php';


use Controllers\DisponibilidadController;
use MVC\Router;
use Controllers\AppController;
use Controllers\ReporteController;
$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/pdf', [ReporteController::class,'pdf']);
$router->get('/disponibilidad/estadistica', [DisponibilidadController::class,'estadistica']);
$router->get('/API/estadistica', [DisponibilidadController::class,'estadisticas']);
$router->get('/API/disponibilidad/buscar', [DisponibilidadController::class,'buscarAPI']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
