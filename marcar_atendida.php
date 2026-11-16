<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $conexion->prepare("UPDATE citas SET estado = 'Atendida' WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        die("Error al actualizar la cita: " . $e->getMessage());
    }
} else {
    header("Location: admin.php");
    exit();
}
?>