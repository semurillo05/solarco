<?php
session_start();
require 'config/db.php';

// ============================================
// GUARDIA DE SEGURIDAD
// Si no hay sesión activa, detener ejecución.
// Nadie puede crear, editar o eliminar sin estar autenticado.
// ============================================
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// ============================================
// SECCIÓN 1: CREAR PROYECTO (INSERT)
// Condición: llega un POST y NO tiene campo 'id'
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['id'])) {

    // 1. Capturar y sanear cada campo del formulario
    $nombre            = trim($_POST['nombre']            ?? '');
    $ciudad            = trim($_POST['ciudad']            ?? '');
    $capacidad_kw      = trim($_POST['capacidad_kw']      ?? '');
    $fecha_instalacion = trim($_POST['fecha_instalacion']  ?? '');
    $estado            = trim($_POST['estado']            ?? '');
    $usuario_id        = $_SESSION['user_id'];

    // 2. Ejecutar el INSERT con Prepared Statement
    $stmt = $pdo->prepare(
        "INSERT INTO proyecto (usuario_id, nombre, ciudad, capacidad_kw, fecha_instalacion, estado)
         VALUES (:usuario_id, :nombre, :ciudad, :capacidad_kw, :fecha_instalacion, :estado)"
    );

    $stmt->execute([
        ':usuario_id'        => $usuario_id,
        ':nombre'            => $nombre,
        ':ciudad'            => $ciudad,
        ':capacidad_kw'      => $capacidad_kw,
        ':fecha_instalacion' => $fecha_instalacion,
        ':estado'            => $estado,
    ]);

    // 3. Redirigir a proyectos.php para ver el nuevo registro
    header('Location: proyectos.php');
    exit;
}

// ============================================
// SECCIÓN 2: EDITAR PROYECTO (UPDATE)
// Condición: llega un POST y SÍ tiene campo 'id'
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {

    // 1. Capturar el ID y todos los campos
    $id                = (int) $_POST['id'];
    $nombre            = trim($_POST['nombre']            ?? '');
    $ciudad            = trim($_POST['ciudad']            ?? '');
    $capacidad_kw      = trim($_POST['capacidad_kw']      ?? '');
    $fecha_instalacion = trim($_POST['fecha_instalacion']  ?? '');
    $estado            = trim($_POST['estado']            ?? '');

    // 2. Ejecutar el UPDATE con Prepared Statement
    $stmt = $pdo->prepare(
        "UPDATE proyecto
         SET nombre = :nombre,
             ciudad = :ciudad,
             capacidad_kw = :capacidad_kw,
             fecha_instalacion = :fecha_instalacion,
             estado = :estado
         WHERE proyecto_id = :id"
    );

    $stmt->execute([
        ':nombre'            => $nombre,
        ':ciudad'            => $ciudad,
        ':capacidad_kw'      => $capacidad_kw,
        ':fecha_instalacion' => $fecha_instalacion,
        ':estado'            => $estado,
        ':id'                => $id,
    ]);

    header('Location: proyectos.php');
    exit;
}

// ============================================
// SECCIÓN 3: ELIMINAR PROYECTO (DELETE)
// Condición: llega un GET con el parámetro 'eliminar'
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['eliminar'])) {

    // 1. Capturar el ID a eliminar
    $id = (int) $_GET['eliminar'];

    // 2. Ejecutar el DELETE con Prepared Statement
    $stmt = $pdo->prepare("DELETE FROM proyecto WHERE proyecto_id = :id");
    
    $stmt->execute([
        ':id' => $id
    ]);

    // 3. Redirigir de vuelta a la tabla
    header('Location: proyectos.php');
    exit;
}
