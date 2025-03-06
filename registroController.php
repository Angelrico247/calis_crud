<?php
require_once 'databaseClass.php';
require_once 'loginClass.php';

$db = new Database();
$conn = $db->connect();

$user = new UserForm();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // Encripta la contraseña


    if ($user->register($username, $password)) {
        http_response_code(201); // Código 201 - Creado
        echo json_encode("usuario creado exitosamente");
    } else {
        http_response_code(500); // Código 500 - Error del servidor
        echo json_encode("no se pudo crear usuario");
    }
    exit();
}
?>
