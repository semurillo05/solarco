<?php
session_start();

// 1. Borrar todas las variables almacenadas en la sesión
session_unset();

// 2. Destruir el archivo de sesión en el servidor
session_destroy();

// 3. Redirigir al inicio
header('Location: index.php');
exit;
?>
