<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SolarCO - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="index.php" class="navbar-logo"><span class="logo-sol">✦</span> SolarCO</a>
        <ul class="navbar-links">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="energia-solar.php">Energía Solar</a></li>
            <li><a href="estadisticas.php">Estadísticas</a></li>
            <li><a href="proyectos.php">Proyectos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="btn-primario">Cerrar Sesión</a>
        <?php else: ?> 
            <a href="#login" class="btn-primario">Iniciar Sesión</a>
        <?php endif; ?>
    </nav>

    <!-- SECCION LOGIN -->
    <main class="login-main">
        <div class="login-box">
            <div class="login-logo">☀</div>
            <h1 class="login-titulo">SolarCO</h1>
            <p class="login-subtitulo">Accede a tu cuenta</p>

            <?php if(isset($_GET['error'])): ?>
                <p class="login-error">Correo o contraseña incorrectos</p>
            <?php endif; ?>

            <form action="login.php" method="POST" id="form-login">
                <div class="campo-grupo">
                    <label for="email">Correo Electrónico</label>
                    <div class="campo-icono">
                        <span>✉</span>
                        <input type="email" id="email" name="email" placeholder="tu@email.com">
                    </div>
                </div>
                <div class="campo-grupo">
                    <label for="password">Contraseña</label>
                    <div class="campo-icono">
                        <span>🔒</span>
                        <input type="password" id="password" name="password" placeholder="••••••••">
                    </div>
                </div>
                <div class="login-opciones">
                    <label class="recordarme">
                        <input type="checkbox"> Recordarme
                    </label>
                    <a href="#" class="link-amarillo">¿Olvidaste tu contraseña?</a>
                </div>
                <button type="submit" class="btn-primario btn-full">Iniciar Sesión</button>
                <p class="login-registro">¿No tienes cuenta? <a href="#" class="link-amarillo">Regístrate</a></p>
            </form>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>
</html>