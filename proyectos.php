<?php
session_start();

require_once 'config/db.php';

$sql = "SELECT * FROM proyecto";
$stmt = $pdo->query($sql);
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SolarCO - Gestión de Proyectos</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">

    <a href="index.php" class="navbar-logo">
        <span class="logo-sol">✦</span> SolarCO
    </a>

    <ul class="navbar-links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="energia-solar.php">Energía solar</a></li>
        <li><a href="estadisticas.php">Estadísticas</a></li>
        <li><a href="proyectos.php">Proyectos</a></li>
        <li><a href="contacto.php">Contacto</a></li>
    </ul>

    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="btn-primario">
            Cerrar Sesión
        </a>
    <?php else: ?>
        <a href="index.php#login" class="btn-primario">
            Iniciar Sesión
        </a>
    <?php endif; ?>

</nav>

<div class="proyectos-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar-proyectos" id="sidebarFiltros">

        <h3>Filtros</h3>

        <label>Estado</label>
<select id="filtroEstado">
    <option value="Todos">Todos</option>
    <option value="Activo">Activo</option>
    <option value="En proceso">En proceso</option>
    <option value="Planificación">Planificación</option>
</select>

        <label>Capacidad</label>
        <select>
            <option>Todas</option>
        </select>

        <label>Fecha</label>
        <select>
            <option>Todo el tiempo</option>
        </select>

    </aside>

    <!-- CONTENIDO -->
    <main class="contenido-proyectos">

        <h1>Gestión de Proyectos</h1>

        <p>
            Administra todos los proyectos de energía solar registrados en SolarCO.
        </p>

        <div class="toolbar">

            <div class="buscador">

                <input
                    type="text"
                    id="buscadorProyectos"
                    placeholder="Buscar proyectos..."
                >

            </div>

            <div class="acciones-toolbar">

                <button type="button" class="btn-filtrar" id="btnFiltrar">
                  Filtrar
                </button>

                <button
                    type="button"
                    class="btn-primario"
                    id="abrirModal"
                >
                    + Nuevo Proyecto
                </button>

            </div>

        </div>

        <table class="tabla-proyectos" id="tablaProyectos">

            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Ciudad</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($proyectos as $proyecto): ?>
                
                <tr data-estado="<?= htmlspecialchars($proyecto['estado']); ?>">


                    <td>
                        <?= htmlspecialchars($proyecto['nombre']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($proyecto['ciudad']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($proyecto['capacidad_kw']); ?> kW
                    </td>

                    <td>

                        <?php

                        $estado = $proyecto['estado'];

                        if($estado == 'Activo'){
                            echo '<span class="badge badge-activo">Activo</span>';
                        }
                        elseif($estado == 'En proceso'){
                            echo '<span class="badge badge-proceso">En proceso</span>';
                        }
                        else{
                            echo '<span class="badge badge-planificacion">Planificación</span>';
                        }

                        ?>

                    </td>

                    <td>
                        <?= htmlspecialchars($proyecto['fecha_instalacion']); ?>
                    </td>

                    <td>

                        <a href="#">👁</a>
                    
                         &nbsp;

                        <a
                            href="#"
                            class="btnEditar"
                            data-id="<?= $proyecto['proyecto_id']; ?>"
                            data-nombre="<?= htmlspecialchars($proyecto['nombre']); ?>"
                            data-ciudad="<?= htmlspecialchars($proyecto['ciudad']); ?>"
                            data-capacidad="<?= $proyecto['capacidad_kw']; ?>"
                            data-fecha="<?= $proyecto['fecha_instalacion']; ?>"
                            data-estado="<?= $proyecto['estado']; ?>"
                        >
                            ✏
                        </a>

                         &nbsp;
                        <a
                            href="acciones.php?eliminar=<?= $proyecto['proyecto_id']; ?>"
                             onclick="return confirm('¿Deseas eliminar este proyecto?');"
                        >
                          🗑
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

        <div class="modal" id="modalProyecto">

            <div class="modal-contenido">

                <div class="modal-header">

                    <h2>Nuevo Proyecto</h2>

                    <span
                        class="cerrar-modal"
                        id="cerrarModal"
                    >
                        ×
                    </span>

                </div>

                <form
                    action="acciones.php"
                    method="POST"
                    class="form-proyecto"
                >

                    <input
                        type="hidden"
                        name="id"
                        id="proyecto_id"
                    >

                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        placeholder="Nombre del proyecto"
                        required
                    >

                    <input
                        type="text"
                        name="ciudad"
                        id="ciudad"
                        placeholder="Ciudad"
                        required
                    >

                    <input
                        type="number"
                        step="0.1"
                        name="capacidad_kw"
                        id="capacidad_kw"
                        placeholder="Capacidad (kW)"
                        required
                    >

                    <input
                        type="date"
                        name="fecha_instalacion"
                        id="fecha_instalacion"
                        required
                    >

                    <select
                        name="estado"
                        id="estado"
                    >
                        <option value="Activo">Activo</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Planificación">Planificación</option>
                    </select>

                    <button
                        type="submit"
                        class="btn-primario"
                    >
                        Guardar Proyecto
                    </button>

                </form>

            </div>

        </div>     

    </main>

</div>

<!-- BUSCADOR EN TIEMPO REAL -->
<script>

const buscador = document.getElementById('buscadorProyectos');
const filtroEstado = document.getElementById('filtroEstado');

function filtrarTabla(){

    let texto = buscador.value.toLowerCase();
    let estadoSeleccionado = filtroEstado.value;

    let filas = document.querySelectorAll('#tablaProyectos tbody tr');

    filas.forEach(function(fila){

        let contenido = fila.textContent.toLowerCase();
        let estadoFila = fila.dataset.estado;

        let coincideBusqueda = contenido.includes(texto);

        let coincideEstado =
            estadoSeleccionado === "Todos" ||
            estadoFila === estadoSeleccionado;

        if(coincideBusqueda && coincideEstado){
            fila.style.display = '';
        }
        else{
            fila.style.display = 'none';
        }

    });

}

buscador.addEventListener('keyup', filtrarTabla);

filtroEstado.addEventListener('change', filtrarTabla);

/* PANEL FILTROS */

const btnFiltrar = document.getElementById('btnFiltrar');
const sidebarFiltros = document.getElementById('sidebarFiltros');

btnFiltrar.addEventListener('click', function(){

    if(sidebarFiltros.style.display === 'none'){
        sidebarFiltros.style.display = 'block';
    }
    else{
        sidebarFiltros.style.display = 'none';
    }

});

const modalProyecto = document.getElementById('modalProyecto');
const abrirModal = document.getElementById('abrirModal');
const cerrarModal = document.getElementById('cerrarModal');

abrirModal.addEventListener('click', function(){

    document.getElementById('proyecto_id').value = '';
    document.getElementById('nombre').value = '';
    document.getElementById('ciudad').value = '';
    document.getElementById('capacidad_kw').value = '';
    document.getElementById('fecha_instalacion').value = '';
    document.getElementById('estado').value = 'Activo';

    modalProyecto.classList.add('activo');

});

cerrarModal.addEventListener('click', function(){
    modalProyecto.classList.remove('activo');
});

window.addEventListener('click', function(e){

    if(e.target === modalProyecto){
        modalProyecto.classList.remove('activo');
    }

});

const botonesEditar = document.querySelectorAll('.btnEditar');

botonesEditar.forEach(function(btn){

    btn.addEventListener('click', function(e){

        e.preventDefault();

        modalProyecto.classList.add('activo');

        document.getElementById('proyecto_id').value =
            this.dataset.id;

        document.getElementById('nombre').value =
            this.dataset.nombre;

        document.getElementById('ciudad').value =
            this.dataset.ciudad;

        document.getElementById('capacidad_kw').value =
            this.dataset.capacidad;

        document.getElementById('fecha_instalacion').value =
            this.dataset.fecha;

        document.getElementById('estado').value =
            this.dataset.estado;

    });

});

</script>

</body>
</html>