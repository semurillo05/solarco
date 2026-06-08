<?php
// Configuración de las credenciales
$host = 'localhost';
$db   = 'solarco';
$user = 'root';
$pass = ''; // Vacío, ya que estamos en entorno local Laragon/XAMPP

try {
    // 1. Crear la conexión (Data Source Name)
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    
    // 2. Configurar PDO para que lance "Excepciones" (errores legibles) si algo falla
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // 3. Si falla, detener la ejecución y mostrar el error
    die("Error crítico de conexión a la base de datos: " . $e->getMessage());
}
?>
