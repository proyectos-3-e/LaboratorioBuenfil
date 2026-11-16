<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

try {
    $conexion->exec("DELETE FROM citas WHERE estado = 'Atendida'");
    header("Location: admin.php");
    exit();
} catch (PDOException $e) {
    die("Error al limpiar el historial: " . $e->getMessage());
}
?>