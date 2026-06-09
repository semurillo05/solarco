<?php
/**
 * SolarCO - Formulario de Contacto y Registro de Comentarios (Diseño Unificado)
 * Desarrollado por: Integrante D (Johan)
 * Fecha: Junio 2026
 */
require_once 'config/db.php';

$mensaje_exito = "";
$mensaje_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $mensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

    if (empty($nombre) || empty($apellido) || empty($email) || empty($mensaje)) {
        $mensaje_error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje_error = "Por favor, ingrese un correo electrónico válido.";
    } else {
        try {
            $sql = "INSERT INTO comentario (nombre, apellido, email, mensaje, fecha_envio) 
                    VALUES (:nombre, :apellido, :email, :mensaje, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $mensaje_exito = "¡Gracias por escribirnos! Su mensaje ha sido enviado correctamente.";
            } else {
                $mensaje_error = "Hubo un problema al guardar el mensaje. Inténtelo de nuevo.";
            }
        } catch (PDOException $e) {
            $mensaje_error = "Error en la base de datos: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - SolarCO</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f6f9; color: #333; }
        header { background-color: #1C2B4A; color: white; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid #C9960C; }
        header h1 { margin: 0; font-size: 24px; color: #fff; }
        nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 20px; }
        nav a { color: #fff; text-decoration: none; font-weight: 500; font-size: 15px; transition: color 0.3s; }
        nav a:hover, nav a.active { color: #C9960C; }
        
        .container { max-width: 600px; margin: 50px auto; background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        h2 { color: #1C2B4A; margin-top: 0; font-size: 28px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        label { display: block; margin-bottom: 7px; font-weight: 600; color: #444; font-size: 14px; }
        input[type="text"], input[type="email"], textarea { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: inherit; font-size: 14px; transition: border-color 0.3s; }
        input:focus, textarea:focus { border-color: #1C2B4A; outline: none; }
        
        button { background-color: #1C2B4A; color: white; padding: 14px 20px; border: none; border-radius: 4px; font-weight: bold; font-size: 16px; cursor: pointer; width: 100%; transition: background-color 0.3s; }
        button:hover { background-color: #152037; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        
        .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border-left: 5px solid #28a745; font-size: 14px; text-align: left; }
        .alert-danger { background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; border-left: 5px solid #dc3545; font-size: 14px; text-align: left; }
        
        /* Contenedor dinámico para errores de JS */
        #contactoErrorContainer { background-color: #fff3cd; color: #856404; padding: 15px; border-radius: 4px; margin-bottom: 20px; border-left: 5px solid #ffc107; font-size: 14px; text-align: left; display: none; }
        
        footer { text-align: center; padding: 20px; background-color: #1C2B4A; color: rgba(255,255,255,0.7); font-size: 14px; border-top: 4px solid #C9960C; margin-top: 60px; }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <h1>SolarCO</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="energia-solar.php">Energía Solar</a></li>
                <li><a href="proyectos.php">Proyectos</a></li>
                <li><a href="contacto.php" class="active">Contacto</a></li>
                <li><a href="estadisticas.php">Estadísticas</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section>
            <h2>Contacto</h2>
            <p style="color: #666; margin-bottom: 30px;">Déjenos su mensaje y un asesor especializado se pondrá en contacto con usted a la brevedad.</p>

            <div id="contactoErrorContainer"></div>

            <?php if (!empty($mensaje_exito)): ?>
                <div class="alert-success"><?php echo htmlspecialchars($mensaje_exito); ?></div>
            <?php endif; ?>

            <?php if (!empty($mensaje_error)): ?>
                <div class="alert-danger"><?php echo htmlspecialchars($mensaje_error); ?></div>
            <?php endif; ?>

            <form id="contactoForm" action="contacto.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre">
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido *</label>
                    <input type="text" id="apellido" name="apellido">
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico *</label>
                    <input type="text" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje o Consulta *</label>
                    <textarea id="mensaje" name="mensaje" rows="5"></textarea>
                </div>

                <button type="submit">Enviar Mensaje</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SolarCO. Todos los derechos reservados.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>