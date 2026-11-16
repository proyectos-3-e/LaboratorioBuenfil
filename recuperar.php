<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios Buenfil web - Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <i class="fa-solid fa-flask-vial fa-lg me-2"></i>
                <span class="fw-bold">Laboratorios Buenfil web</span>
            </a>
        </div>
    </nav>

    <main class="container my-auto py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow border-0 rounded-4 p-4 p-md-5 bg-white">
                    
                    <div class="text-center mb-4">
                        <div class="bg-primary-subtle text-primary p-3 rounded-circle d-inline-flex mb-3">
                            <i class="fa-solid fa-key fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-dark m-0">Recuperar Contraseña</h2>
                        <p class="text-muted small mt-1">Ingresa tus datos para restablecer tu contraseña.</p>
                    </div>

                    <form action="procesar_recuperacion.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Correo electrónico registrado *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" class="form-control" name="correo" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Teléfono registrado *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-phone"></i></span>
                                <input type="text" class="form-control" name="telefono" placeholder="Tu número de teléfono" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Nueva contraseña *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" name="nueva_password" placeholder="Nueva contraseña" required>
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm">
                                Actualizar contraseña
                            </button>
                        </div>

                        <div class="text-center">
                            <small class="text-muted"><a href="login.php" class="text-primary text-decoration-none fw-bold"><i class="fa-solid fa-arrow-left me-1"></i> Volver al inicio de sesión</a></small>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-top py-4 mt-auto text-muted text-center">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 Laboratorios Buenfil web. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>