<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios BuenFil Website - Inicio</title><!-- Titulo de la pagina mas chida del Mante -->

    <!-- La libreria de Boostrap para ayudar al diseño del codigo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
   
    <!-- NavBar y sus clases con sus Divs y asi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <!-- Logotipo y Nombre -->
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <i class="fa-solid fa-flask-vial fa-lg me-2"></i>
                <span class="fw-bold">Laboratorios Buenfil web</span>
            </a>

            <!-- Botón hamburguesa para celulares -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="promociones.php">DESCUENTOS Y PROMOCIONES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="citas.php">CONSULTAS</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-light rounded-pill px-3" href="registro.php">
                            <i class="fa-regular fa-user me-1"></i> REGISTRARSE
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL DE LA PÁGINA DE INICIO -->
    <main class="container my-5">
        <div class="row align-items-center g-4">
            
            <!--Tarjeta de Ofertas y Promociones -->
            <div class="col-md-6">
                <div class="card shadow border-0 p-4 bg-white rounded-4 text-center">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 border border-danger rounded bg-warning-subtle">
                                <h3 class="text-danger fw-bold m-0">OFERTA</h3>
                                <span class="display-5 fw-bold text-dark">-50%</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border border-warning rounded bg-danger-subtle">
                                <h3 class="text-warning-emphasis fw-bold m-0">PROMOCIÓN</h3>
                                <span class="display-5 fw-bold text-danger">2x1</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-muted small">Aprovecha nuestros descuentos especiales en estudios clínicos seleccionados este mes.</p>
                    </div>
                </div>
            </div>

            <!--Texto de bienvenida y llamado a la acción -->
            <div class="col-md-6 text-center text-md-start">
                <h1 class="fw-bold text-primary mb-3">Tu salud, nuestra prioridad</h1>
                <p class="text-secondary mb-4">
                    Realiza tus estudios clínicos de forma rápida y segura. Agenda tu cita en línea o revisa las promociones vigentes que tenemos para ti y tu familia.
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                    <a href="citas.php" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fa-regular fa-calendar-days me-2"></i> Agendar Cita
                    </a>
                    <a href="promociones.php" class="btn btn-outline-secondary btn-lg">
                        Más ofertas aquí
                    </a>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer  -->
    <footer class="bg-white border-top py-4 mt-auto text-center text-muted">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 Laboratorios Buenfil web. Todos los derechos reservados (No se la roben porfabor).</p>
        </div>
    </footer>

    <!--Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>