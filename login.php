<?php
session_start();
require 'config/db.php';

// Bloquear acceso directo por URL (solo acepta POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// 1. Capturar y sanear los datos del formulario
$email    = trim($_POST['email']    ?? '');
$password = trim($_POST['password'] ?? '');

// 2. Validar que los campos no estén vacíos
if (empty($email) || empty($password)) {
    header('Location: index.php?error=1');
    exit;
}

// 3. Buscar el usuario en la BD usando Prepared Statement
$stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email LIMIT 1");
$stmt->execute([':email' => $email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// 4. Verificar si existe y si la contraseña coincide
if ($usuario && $usuario['password'] === $password) {
    // Login exitoso: guardar datos en la sesión
    $_SESSION['user_id']   = $usuario['usuario_id'];
    $_SESSION['user_name'] = $usuario['nombre'];
    header('Location: proyectos.php');
    exit;
} else {
    // Credenciales incorrectas
    header('Location: index.php?error=1');
    exit;
}
?>
