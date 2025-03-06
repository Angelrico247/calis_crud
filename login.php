<?php
session_start();
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

require_once "loginClass.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = new UserForm();

    if ($user->login($username, $password)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
        echo "echo";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form method="POST">
        <label>Usuario:</label>
        <input type="text" name="username" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Iniciar sesión</button>
    </form>

    <div class="text-center mt-3">
        <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
    </div>
</body>

</html>