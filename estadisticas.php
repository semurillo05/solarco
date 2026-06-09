<?php
/**
 * SolarCO - Panel de Estadísticas Completo (Módulo 3.3)
 * Desarrollado por: Johan Villalba
 * Fecha: Junio 2026
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas - SolarCO</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f6f9; color: #333; }
        header { background-color: #1C2B4A; color: white; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid #C9960C; }
        header h1 { margin: 0; font-size: 24px; color: #fff; }
        nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 20px; }
        nav a { color: #fff; text-decoration: none; font-weight: 500; font-size: 15px; transition: color 0.3s; }
        nav a:hover, nav a.active { color: #C9960C; }
        
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; text-align: center; }
        h2 { color: #1C2B4A; font-size: 28px; margin-bottom: 10px; }
        .subtitle { color: #666; margin-bottom: 30px; font-size: 16px; }

        /* REQUERIMIENTO 3.3.2: 4 Tarjetas de Métricas */
        .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: left; border-top: 4px solid #1C2B4A; }
        .card:nth-child(even) { border-top-color: #C9960C; }
        .card h3 { margin: 0; color: #666; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; }
        .card .value { font-size: 24px; font-weight: bold; color: #1C2B4A; margin: 10px 0 5px 0; }
        .card .increment { font-size: 13px; color: #28a745; font-weight: 600; display: flex; align-items: center; gap: 4px; }

        /* Contenedor de Gráficos */
        .charts-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 30px; margin-bottom: 40px; }
        .chart-box { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #e1e8ed; }
        .chart-box h4 { margin-top: 0; margin-bottom: 20px; color: #1C2B4A; font-size: 16px; text-align: left; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        
        canvas { background-color: #ffffff; max-width: 100%; display: block; margin: 0 auto; }
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
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="estadisticas.php" class="active">Estadísticas</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section>
            <h2>Panel de Control y Estadísticas</h2>
            <p class="subtitle">Monitoreo del rendimiento energético e indicadores clave a nivel nacional.</p>

            <div class="metrics-grid">
                <div class="card">
                    <h3>Energía Generada</h3>
                    <div class="value">32,450 kWh</div>
                    <div class="increment">▲ +12.4% este mes</div>
                </div>
                <div class="card">
                    <h3>Ahorro Estimado</h3>
                    <div class="value">$45.2M</div>
                    <div class="increment">▲ +8.2% vs año anterior</div>
                </div>
                <div class="card">
                    <h3>CO₂ Evitado</h3>
                    <div class="value">18.5 ton</div>
                    <div class="increment">▲ +15.1% de mitigación</div>
                </div>
                <div class="card">
                    <h3>Proyectos Activos</h3>
                    <div class="value">1,247</div>
                    <div class="increment">▲ +5.3% nuevos sistemas</div>
                </div>
            </div>

            <div class="charts-grid">
                <div class="chart-box">
                    <h4>Producción vs Consumo (Últimos 6 Meses)</h4>
                    <canvas id="canvasBarras" width="450" height="300"></canvas>
                </div>

                <div class="chart-box">
                    <h4>Tendencia de Producción Mensual (MWh)</h4>
                    <canvas id="canvasLinea" width="450" height="300"></canvas>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SolarCO. Todos los derechos reservados.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // ==========================================
            // REQUERIMIENTO 3.3.3: GRÁFICA DE BARRAS DOBLES
            // ==========================================
            const canvasB = document.getElementById("canvasBarras");
            if (canvasB) {
                const ctx = canvasB.getContext("2d");
                const meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun"];
                const produccion = [420, 480, 520, 590, 610, 680];
                const consumo = [380, 410, 440, 490, 500, 540];

                const margen = { sup: 30, der: 20, inf: 40, izq: 40 };
                const ancho = canvasB.width - margen.izq - margen.der;
                const alto = canvasB.height - margen.sup - margen.inf;
                const maxVal = 800;

                // Ejes
                ctx.beginPath();
                ctx.strokeStyle = "#888";
                ctx.lineWidth = 1.5;
                ctx.moveTo(margen.izq, margen.sup);
                ctx.lineTo(margen.izq, canvasB.height - margen.inf);
                ctx.lineTo(canvasB.width - margen.der, canvasB.height - margen.inf);
                ctx.stroke();

                // Cuadrícula y Etiquetas Y
                ctx.font = "10px sans-serif";
                ctx.fillStyle = "#666";
                ctx.textAlign = "right";
                for(let i=0; i<=4; i++) {
                    let val = (maxVal / 4) * i;
                    let y = (canvasB.height - margen.inf) - (alto * (val / maxVal));
                    ctx.fillText(val, margen.izq - 8, y + 3);
                    
                    ctx.beginPath();
                    ctx.strokeStyle = "#f0f0f0";
                    ctx.moveTo(margen.izq, y);
                    ctx.lineTo(canvasB.width - margen.der, y);
                    ctx.stroke();
                }

                // Dibujar barras dobles (Producción vs Consumo)
                const numGrupos = meses.length;
                const anchoSeccion = ancho / numGrupos;
                const anchoBarra = anchoSeccion * 0.35;

                meses.forEach((mes, idx) => {
                    const xGrupo = margen.izq + (idx * anchoSeccion);
                    
                    // Barra Producción (Azul Marino)
                    const hProd = alto * (produccion[idx] / maxVal);
                    const yProd = (canvasB.height - margen.inf) - hProd;
                    ctx.fillStyle = "#1C2B4A";
                    ctx.fillRect(xGrupo + (anchoSeccion * 0.1), yProd, anchoBarra, hProd);

                    // Barra Consumo (Amarillo)
                    const hCons = alto * (consumo[idx] / maxVal);
                    const yCons = (canvasB.height - margen.inf) - hCons;
                    ctx.fillStyle = "#C9960C";
                    ctx.fillRect(xGrupo + (anchoSeccion * 0.1) + anchoBarra + 2, yCons, anchoBarra, hCons);

                    // Etiqueta X
                    ctx.fillStyle = "#333";
                    ctx.textAlign = "center";
                    ctx.fillText(mes, xGrupo + (anchoSeccion / 2), canvasB.height - margen.inf + 18);
                });
            }

            // ==========================================
            // REQUERIMIENTO 3.3.4: GRÁFICA DE LÍNEA TENDENCIA
            // ==========================================
            const canvasL = document.getElementById("canvasLinea");
            if (canvasL) {
                const ctx = canvasL.getContext("2d");
                const meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun"];
                const tendencia = [210, 290, 350, 480, 620, 790]; // Crecimiento exponencial

                const margen = { sup: 30, der: 20, inf: 40, izq: 40 };
                const ancho = canvasL.width - margen.izq - margen.der;
                const alto = canvasL.height - margen.sup - margen.inf;
                const maxVal = 1000;

                // Ejes
                ctx.beginPath();
                ctx.strokeStyle = "#888";
                ctx.moveTo(margen.izq, margen.sup);
                ctx.lineTo(margen.izq, canvasL.height - margen.inf);
                ctx.lineTo(canvasL.width - margen.der, canvasL.height - margen.inf);
                ctx.stroke();

                // Etiquetas Y
                ctx.font = "10px sans-serif";
                ctx.fillStyle = "#666";
                ctx.textAlign = "right";
                for(let i=0; i<=4; i++) {
                    let val = (maxVal / 4) * i;
                    let y = (canvasL.height - margen.inf) - (alto * (val / maxVal));
                    ctx.fillText(val, margen.izq - 8, y + 3);
                }

                // Trazado de la Línea de Tendencia
                const anchoSeccion = ancho / meses.length;
                ctx.beginPath();
                ctx.strokeStyle = "#1C2B4A";
                ctx.lineWidth = 3;

                let puntos = [];
                meses.forEach((mes, idx) => {
                    const x = margen.izq + (idx * anchoSeccion) + (anchoSeccion / 2);
                    const y = (canvasL.height - margen.inf) - (alto * (tendencia[idx] / maxVal));
                    puntos.push({x: x, y: y});

                    if(idx === 0) ctx.moveTo(x, y);
                    else ctx.lineTo(x, y);

                    // Escribir etiqueta X
                    ctx.fillStyle = "#333";
                    ctx.textAlign = "center";
                    ctx.fillText(mes, x, canvasL.height - margen.inf + 18);
                });
                ctx.stroke();

                // Dibujar puntos decorativos amarillos en las uniones
                puntos.forEach((pt) => {
                    ctx.beginPath();
                    ctx.fillStyle = "#C9960C";
                    ctx.arc(pt.x, pt.y, 5, 0, 2 * Math.PI);
                    ctx.fill();
                    ctx.stroke();
                });
            }
        });
    </script>
</body>
</html>