<?php
session_start();
include 'conexion.php';

if (isset($_GET['id'])) {
    $cita_id = intval($_GET['id']);

    $stmt = $conexion->prepare("UPDATE citas SET estado = 'Cancelada' WHERE id = :id");
    $stmt->bindParam(':id', $cita_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>
                alert('La cita ha sido cancelada correctamente.');
                window.location='citas.php';
              </script>";
    } else {
        echo "<script>
                alert('Hubo un error al intentar cancelar la cita.');
                window.location='citas.php';
              </script>";
    }
} else {
    header("Location: citas.php");
}
?>