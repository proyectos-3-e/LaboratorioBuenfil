<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        // 1. Buscar en la tabla ADMINISTRADOR
        $sqlAdmin = "SELECT * FROM administrador WHERE correo = :correo";
        $stmtAdmin = $conexion->prepare($sqlAdmin);
        $stmtAdmin->execute([':correo' => $correo]);
        $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

        if ($admin && $password === $admin['contraseña']) {
            $_SESSION['usuario_id'] = $admin['id'];
            $_SESSION['nombre_usuario'] = $admin['nombre'] ?? 'Administrador';
            $_SESSION['rol'] = 'admin';

            echo "<script>
                    alert('¡Bienvenido Dr. " . ($admin['nombre'] ?? 'Administrador') . "!');
                    window.location='index.php';
                  </script>";
            exit();
        }

        // 2. Buscar en la tabla LABORATORISTA
        $sqlLab = "SELECT * FROM laboratorista WHERE correo = :correo";
        $stmtLab = $conexion->prepare($sqlLab);
        $stmtLab->execute([':correo' => $correo]);
        $lab = $stmtLab->fetch(PDO::FETCH_ASSOC);

        if ($lab && (password_verify($password, $lab['contraseña']) || $password === $lab['contraseña'])) {
            $_SESSION['usuario_id'] = $lab['id'];
            $_SESSION['nombre_usuario'] = $lab['nombre_completo'];
            $_SESSION['rol'] = 'laboratorista'; // ¡Clave para que pinte el botón en el index!

            echo "<script>
                    alert('¡Bienvenido Laboratorista " . $lab['nombre_completo'] . "!');
                    window.location='index.php';
                  </script>";
            exit();
        }

        // 3. Buscar en la tabla USUARIO (Pacientes)
        $sqlUsuario = "SELECT * FROM usuario WHERE correo = :correo";
        $stmtUsuario = $conexion->prepare($sqlUsuario);
        $stmtUsuario->execute([':correo' => $correo]);
        $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre'];
            $_SESSION['rol'] = 'paciente';

            echo "<script>
                    alert('¡Bienvenido de nuevo, " . $usuario['nombre'] . "!');
                    window.location='index.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Correo o contraseña incorrectos.');
                    window.location='login.php';
                  </script>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>