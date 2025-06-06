<?php
// Se encarga de la lógica del acceso de los usuarios

session_start();
require_once 'pdo_bind_connection.php';

// Verificar lo que llega a login.php
$verificarUsuario = isset($_POST['usuario']) && $_POST['usuario'];
$verificarpassword = isset($_POST['password']) && $_POST['password'];

if (!$verificarUsuario || !$verificarpassword ) {
    $_SESSION['error_cuenta'] = true;
    header('Location: crear_cuenta.php');
    exit();
} 
// Quitar espacios en blanco
$usuario = trim($_POST['usuario']);
$password = trim($_POST['password']);


// Verificar que no senvien datos vacíos
if (empty($usuario) || empty($password) ) {
    $_SESSION['error_cuenta'] = true;
    header('Location: crear_cuenta.php');
    exit();
}

$usuario = htmlentities($usuario, ENT_QUOTES, 'UTF-8');
$password = htmlentities($password, ENT_QUOTES, 'UTF-8');

// Verificar si el usuario existe
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario"); 
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->execute();
$usuarioExistente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuarioExistente) {
    $_SESSION['user_inexistente'] = true;
    header('Location: crear_cuenta.php');
    exit();
}

// Verificar la contraseña
if (!password_verify($password, $usuarioExistente['password'])) {
    $_SESSION['user_inexistente'] = true;
    header('Location: index.php');
    exit();
}

echo "Todo OK";

// Sintaxis básica de cookie
setcookie("usuario", $usuarioExistente['usuario'], time() + (60), "/" ); // tiempo en segundos

/*
// Sintaxis detallada de cookie
setcookie(
    "usuario", 
    $usuarioExistente['usuario'], [
        "expires" => time() + (60),
        "httponly" => true, // acceder sólo desde el servidor
        "secure" => true,  // la cookie solo se puede enviar por https
        "path" => "/", // la cookie es accesible desde cualquier ruta del proyecto
        "samesite" => "Strict" // disponer de la cookie solo si se llega desde la barra de navegación ("Lax" desde cualquier sitio)
    ]);
*/


$_SESSION['usuario'] = $usuarioExistente['usuario'];
$_SESSION['id_usuario'] = $usuarioExistente['id_usuario'];
header('Location: colores/index.php');
