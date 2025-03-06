<?php

require_once "auth.php";
require_once "userClass.php";

$method = $_SERVER["REQUEST_METHOD"];
$user = new User();

switch ($method) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        // Validar que los datos existen y no estén vacíos
        if (!$data || empty($data['name']) || empty($data['email'])) {
            http_response_code(400);
            echo json_encode(["message" => "Faltan datos obligatorios o están vacíos"]);
            exit;
        }
        
        if ($user->createUser($data['name'], $data['email'])) {
            http_response_code(201);
            echo json_encode(["message" => "Usuario creado correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "No se pudo crear usuario"]);
        }
        

    case "GET":
        $user = $user->getAll();
        if ($user) {
            http_response_code(200);
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo "no se pudieron cargar usuarios";
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || empty($data['id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Faltan datos obligatorios o están vacíos"]);
            exit;
        }

        if ($user->deleteUser($data['id'])) {
            http_response_code(200);
            echo "usuario eliminado correctamente";
        } else {
            http_response_code(500);
            echo "no se pudo eliminar usuario";
        };
        break;


    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || empty($data['id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Faltan datos obligatorios o están vacíos"]);
            exit;
        }

        if ($user->updateUser($data['id'], $data['name'], $data['email'])) {
            http_response_code(200);
            echo "usuario actualizado correctamente";
        } else {
            http_response_code(500);
            echo "no se pudo actualizar usuario";
        };
        break;

        default: 
        http_response_code(405);
        echo "metodo no soportado";
}
