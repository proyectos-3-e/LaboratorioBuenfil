<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios Buenfil web - Registro de Paciente</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- BARRA DE NAVEGACIÓN SUPERIOR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <i class="fa-solid fa-flask-vial fa-lg me-2"></i>
                <span class="fw-bold">Laboratorios Buenfil web</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="promociones.php">DESCUENTOS Y PROMOCIONES</a></li>
                    <li class="nav-item"><a class="nav-link" href="citas.php">CONSULTAS</a></li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-light rounded-pill px-3 active" href="registro.php">
                            <i class="fa-regular fa-user me-1"></i> REGISTRARSE
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--FORMULARIO DE REGISTRO -->
    <main class="container my-auto py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow border-0 rounded-4 p-4 p-md-5 bg-white">
                    
                    <!-- Encabezado del Formulario -->
                    <div class="text-center mb-4">
                        <div class="bg-primary-subtle text-primary p-3 rounded-circle d-inline-flex mb-3">
                            <i class="fa-solid fa-user-plus fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-dark m-0">Crear una cuenta</h2>
                        <p class="text-muted small mt-1">Regístrate para gestionar tus citas y ver tus resultados más fácil.</p>
                    </div>

                    <form action="procReg.php" method="POST">
                        
                        <!-- Nombre completo -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nombre completo *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-user"></i></span>
                                <input type="text" class="form-control" name="nombre" placeholder="Ej. Villareal Cuevas Rubi Gemma" required>
                            </div>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Correo electrónico *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" class="form-control" name="correo" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Teléfono celular *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-phone"></i></span>
                                <input type="tel" class="form-control" name="telefono" placeholder="10 dígitos" required>
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Contraseña *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Crea una contraseña segura" required>
                            </div>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm">
                                Registrarme

                            </button>
                        </div>

                        <!-- Enlace de inicio de sesión -->
                        <div class="text-center">
                            <small class="text-muted">¿Ya tienes una cuenta? <a href="login.php" class="text-primary text-decoration-none fw-bold">Inicia sesión aquí</a></small>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-4 mt-auto text-muted text-center">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 Laboratorios Buenfil web. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>