<?php

// Incluir las clases necesarias
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../classes/Posnet.php';
require_once __DIR__ . '/../classes/Tarjeta.php';

$posnet = new Posnet();

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

try {
    if ($method == 'POST' && isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'registerCard':
                $tarjeta = new Tarjeta(
                    $data['numero'],
                    $data['entidadBancaria'],
                    $data['tipo'],
                    $data['limiteDisponible'],
                    $data['titularDNI'],
                    $data['titularNombre'],
                    $data['titularApellido']
                );
                $posnet->registerCard($tarjeta);
                echo json_encode(["message" => "Tarjeta registrada con éxito."]);
                break;

            case 'doPayment':
                $ticket = $posnet->doPayment($data['numeroTarjeta'], $data['monto'], $data['cuotas']);
                echo json_encode(["ticket" => $ticket]);
                break;

            default:
                throw new Exception("Acción no válida.");
        }
    } else {
        throw new Exception("Método no soportado o falta de parámetros.");
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}
