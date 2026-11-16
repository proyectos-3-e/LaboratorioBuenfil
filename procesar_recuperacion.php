<?php
session_start();
include 'conexion.php'; // Asegúrate de que este sea el nombre de tu archivo de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $nueva_password = $_POST['nueva_password'] ?? '';

    if (empty($correo) || empty($telefono) || empty($nueva_password)) {
        echo "<script>alert('Por favor completa todos los campos.'); window.location='recuperar.php';</script>";
        exit();
    }

    try {
        // Verificar si el correo y el teléfono coinciden en la tabla usuario
        $stmt = $conexion->prepare("SELECT id FROM usuario WHERE correo = :correo AND telefono = :telefono");
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Cifrar la nueva contraseña de forma segura
            $password_cifrada = password_hash($nueva_password, PASSWORD_DEFAULT);

            // Actualizar contraseña respetando la columna con 'ñ' usando acentos graves
            $stmt_update = $conexion->prepare("UPDATE usuario SET `contraseña` = :contrasena WHERE correo = :correo");
            $stmt_update->bindParam(':contrasena', $password_cifrada, PDO::PARAM_STR);
            $stmt_update->bindParam(':correo', $correo, PDO::PARAM_STR);
            
            if ($stmt_update->execute()) {
                echo "<script>
                        alert('¡Contraseña actualizada con éxito! Ya puedes iniciar sesión.');
                        window.location='login.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Error al actualizar la contraseña en la base de datos.');
                        window.location='recuperar.php';
                      </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('El correo electrónico o el teléfono no coinciden con ningún registro.');
                    window.location='recuperar.php';
                  </script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Error de sistema: " . addslashes($e->getMessage()) . "');
                window.location='recuperar.php';
              </script>";
        exit();
    }
} else {
    header("Location: recuperar.php");
    exit();
}
?>