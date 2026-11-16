<?php
session_start();
include("conexion.php");

// Validar que exista sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $estudio = $_POST['estudio'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';

    try {
        // Consultar los datos reales del paciente en la base de datos usando su ID de sesión
        $stmtUser = $conexion->prepare("SELECT nombre, telefono, correo FROM usuario WHERE id = :id");
        $stmtUser->execute([':id' => $usuario_id]);
        $paciente = $stmtUser->fetch(PDO::FETCH_ASSOC);

        if ($paciente) {
            $nombre_completo = $paciente['nombre'];
            $telefono = $paciente['telefono'];
            $correo = $paciente['correo'];

            // Insertar la cita en la tabla 'citas' con los datos obtenidos automáticamente
            $sql = "INSERT INTO citas (estudio, fecha, hora, nombre_completo, telefono, correo) 
                    VALUES (:estudio, :fecha, :hora, :nombre_completo, :telefono, :correo)";
            
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':estudio' => $estudio,
                ':fecha' => $fecha,
                ':hora' => $hora,
                ':nombre_completo' => $nombre_completo,
                ':telefono' => $telefono,
                ':correo' => $correo
            ]);

            echo "<script>
                    alert('¡Cita agendada correctamente!');
                    window.location='index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: No se encontró información del paciente.');
                    window.location='citas.php';
                  </script>";
        }

    } catch (PDOException $e) {
        echo "Error al guardar la cita: " . $e->getMessage();
    }
}
?>