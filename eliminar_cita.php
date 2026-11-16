<?php
session_start();
include("conexion.php");

// Validar que sea administrador
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Eliminar la cita de la base de datos
        $stmt = $conexion->prepare("DELETE FROM citas WHERE id = :id");
        $stmt->execute([':id' => $id]);

        echo "<script>
                alert('Cita marcada como atendida y eliminada de los registros.');
                window.location='admin.php';
              </script>";
        exit();

    } catch (PDOException $e) {
        echo "Error al eliminar la cita: " . $e->getMessage();
    }
} else {
    header("Location: admin.php");
    exit();
}
?>