<?php

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $contrasena = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    $rol = "paciente";
    $fecha_registro = date("Y-m-d H:i:s");

    try {

        $sql = "INSERT INTO usuario
                (nombre, correo, telefono, contraseña, rol, fecha_registro)
                VALUES
                (:nombre, :correo, :telefono, :contrasena, :rol, :fecha_registro)";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':telefono' => $telefono,
            ':contrasena' => $contrasena,
            ':rol' => $rol,
            ':fecha_registro' => $fecha_registro
        ]);

        echo "<script>
                alert('Usuario registrado correctamente');
                window.location='login.php';
              </script>";

    } catch (PDOException $e) {

        echo "Error: " . $e->getMessage();

    }
}
?>