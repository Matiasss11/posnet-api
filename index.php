<?php
// Mostrar errores para depuración (deshabilitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Cargar las clases necesarias
require_once __DIR__ . '/vendor/autoload.php';

// Verificar la URL para dirigir las solicitudes al endpoint correcto
if (isset($_SERVER['PATH_INFO'])) {
    $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
    $endpoint = $request[0];

    switch ($endpoint) {
        case 'posnet':
            require './src/api/posnet.php';
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint no encontrado."]);
            break;
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Ruta no válida."]);
}
