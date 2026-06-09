<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SolarCO - Energía solar</title>
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
            <a href="index.php" class="btn-primario">Iniciar Sesión</a>
        <?php endif; ?>
    </nav>

    <!-- HERO -->
    <section class="hero-secundario">
        <div class="hero-secundario-contenido">
            <div class="hero-sol" style="color: var(--amarillo)">✦</div>
            <h1>Energía solar en Colombia</h1>
            <p>Aprovecha el potencial del sol para generar energía limpia y sostenible</p>
        </div>
    </section>

    <!-- TARJETAS DE SERVICIOS -->
    <section class="servicios">
        <div class="servicios-grid">
            <div class="tarjeta-servicio">
                <div class="tarjeta-icono">🏠</div>
                <h2>Sistemas Residenciales</h2>
                <p>Soluciones personalizadas para tu hogar con paneles de alta eficiencia</p>
                <ul class="tarjeta-lista">
                    <li>Instalación rápida y profesional</li>
                    <li>Monitoreo en tiempo real</li>
                    <li>Garantía extendida</li>
                    <li>Asesoría personalizada</li>
                </ul>
            </div>
            <div class="tarjeta-servicio">
                <div class="tarjeta-icono">🏢</div>
                <h2>Sistemas Comerciales</h2>
                <p>Proyectos a gran escala para empresas e industrias</p>
                <ul class="tarjeta-lista">
                    <li>Reducción de costos operativos</li>
                    <li>Consultoría especializada</li>
                    <li>Mantenimiento preventivo</li>
                    <li>Análisis de ROI detallado</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- POR QUE ENERGIA SOLAR -->
    <section class="porque-solar">
        <h2>¿Por qué elegir energía solar?</h2>
        <div class="porque-grid">
            <div class="porque-tarjeta">
                <p class="porque-numero">100%</p>
                <p class="porque-label">Renovable</p>
            </div>
            <div class="porque-tarjeta">
                <p class="porque-numero">25 años</p>
                <p class="porque-label">Vida útil paneles</p>
            </div>
            <div class="porque-tarjeta">
                <p class="porque-numero">0%</p>
                <p class="porque-label">Emisiones CO₂</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <p>© 2026 SolarCO — Todos los derechos reservados</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>