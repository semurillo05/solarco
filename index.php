<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SolarCO - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="index.php" class="navbar-logo"><span class="logo-sol">✦</span> SolarCO</a>
        <ul class="navbar-links">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="energia-solar.php">Energía solar</a></li>
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

    <!-- HERO -->
    <section class="hero">
        <div class="hero-contenido">
            <h1>Energía solar para un Futuro Sostenible</h1>
            <p>Transformamos la energía del sol en soluciones sostenibles para Colombia</p>
            <div class="hero-botones">
                <a href="energia-solar.php" class="btn-primario">Conoce más →</a>
                <a href="contacto.php" class="btn-secundario">Contáctanos</a>
            </div>
        </div>
        <div class="hero-imagen">
            <div class="hero-sol-grande">☀</div>
        </div>
    </section>

    <!-- BENEFICIOS -->
    <section class="beneficios">
        <h2>Beneficios de la energía solar</h2>
        <div class="beneficios-grid">
            <div class="tarjeta-beneficio">
                <div class="tarjeta-icono">⚡</div>
                <h3>Ahorro Energético</h3>
                <p>Reduce hasta un 80% en tus costos de energía</p>
            </div>
            <div class="tarjeta-beneficio">
                <div class="tarjeta-icono">🌿</div>
                <h3>Energía Limpia</h3>
                <p>Contribuye a la preservación del medio ambiente</p>
            </div>
            <div class="tarjeta-beneficio">
                <div class="tarjeta-icono">📈</div>
                <h3>Retorno de Inversión</h3>
                <p>Recupera tu inversión en promedio de 5 años</p>
            </div>
        </div>
    </section>

    <!-- BANDA ESTADISTICAS -->
    <section class="banda-stats">
        <div class="stat">
            <p class="stat-numero">500+</p>
            <p class="stat-label">Proyectos Instalados</p>
        </div>
        <div class="stat">
            <p class="stat-numero">25 MW</p>
            <p class="stat-label">Capacidad Total</p>
        </div>
        <div class="stat">
            <p class="stat-numero">15K</p>
            <p class="stat-label">Toneladas CO₂ Evitadas</p>
        </div>
        <div class="stat">
            <p class="stat-numero">98%</p>
            <p class="stat-label">Satisfacción Cliente</p>
        </div>
    </section>

    <!-- LOGIN -->
    <section id="login" class="login-main">
        <div class="login-box">
            <div class="login-logo">☀</div>
            <h2 class="login-titulo">SolarCO</h2>
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
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <p>© 2026 SolarCO — Todos los derechos reservados</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>