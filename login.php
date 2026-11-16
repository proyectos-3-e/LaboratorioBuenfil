<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios Buenfil web - Iniciar Sesión</title>
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
                            <i class="fa-solid fa-right-to-bracket fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-dark m-0">Iniciar Sesión</h2>
                        <p class="text-muted small mt-1">Ingresa tus datos para acceder a tu cuenta.</p>
                    </div>

                    <form action="procLogin.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Correo electrónico *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" class="form-control" name="correo" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label text-muted small fw-bold">Contraseña *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Tu contraseña" required>
                            </div>
                        </div>

                        <div class="text-end mb-4">
                            <a href="recuperar.php" class="text-decoration-none small text-primary fw-medium">¿Olvidaste tu contraseña?</a>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm">
                                Ingresar
                            </button>
                        </div>

                        <div class="text-center">
                            <small class="text-muted">¿No tienes una cuenta? <a href="registro.php" class="text-primary text-decoration-none fw-bold">Regístrate aquí</a></small>
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