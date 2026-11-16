<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios Buenfil web - Promociones y Descuentos</title>
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
                    <li class="nav-item"><a class="nav-link active" href="promociones.php">DESCUENTOS Y PROMOCIONES</a></li>
                    <li class="nav-item"><a class="nav-link" href="citas.php">CONSULTAS</a></li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <?php if (isset($_SESSION['nombre_usuario'])): ?>
                            <span class="text-white me-3 small">
                                <i class="fa-solid fa-user-doctor me-1"></i> Hola, <strong><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></strong>
                            </span>

                            <!-- Botón directo al Panel Admin si la sesión es de administrador -->
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                                <a class="btn btn-warning btn-sm rounded-pill px-3 fw-bold me-2 text-dark shadow-sm" href="admin.php">
                                    <i class="fa-solid fa-shield-halved me-1"></i> Panel Admin
                                </a>
                            <?php endif; ?>

                            <a class="btn btn-outline-light rounded-pill px-3" href="logout.php">
                                <i class="fa-solid fa-right-from-bracket me-1"></i> Cerrar sesión
                            </a>
                        <?php else: ?>
                            <a class="btn btn-outline-light rounded-pill px-3" href="registro.php">
                                <i class="fa-regular fa-user me-1"></i> REGISTRARSE
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- BANNER DE ENCABEZADO -->
    <header class="bg-primary bg-gradient text-white py-5 mb-5 shadow-sm">
        <div class="container text-center py-3">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-3">
                <i class="fa-solid fa-ribbon me-1"></i> Campaña de Salud
            </span>
            <h1 class="display-4 fw-black mb-2">Promociones y Detección Oportuna</h1>
            <p class="lead max-w-200 mx-auto text-white-50">La prevención es la herramienta más poderosa. Aprovecha nuestros descuentos especiales en marcadores tumorales y check-ups.</p>
        </div>
    </header>

    <!-- CONTENIDO PRINCIPAL DE OFERTAS -->
    <main class="container mb-5 flex-grow-1">

        <!-- BANNER DESTACADO: DÍA Y MES CONTRA EL CÁNCER -->
        <div class="card border-0 shadow-lg rounded-4 p-4 mb-5 overflow-hidden text-white" style="background: linear-gradient(135deg, #e83e8c 0%, #a82355 100%);">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-white text-danger font-monospace px-3 py-2 rounded-pill mb-2 fw-bold">
                        <i class="fa-solid fa-ribbon text-danger me-1"></i> EDICIÓN ESPECIAL PREVENCIÓN
                    </span>
                    <h2 class="fw-bold display-6 mb-2">Campaña de Concientización y Detección Temprana</h2>
                    <p class="mb-3 mb-lg-0">Un diagnóstico oportuno salva vidas. Obtén hasta un <strong>50% de descuento</strong> en todos tus estudios de marcadores tumorales y perfiles de salud durante todo este mes.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="citas.php" class="btn btn-light btn-lg fw-bold px-4 py-3 text-danger rounded-pill shadow">
                        <i class="fa-solid fa-calendar-plus me-2"></i> Agendar mi Chequeo
                    </a>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: OFERTAS ESPECIALES DE CÁNCER Y PREVENCIÓN -->
        <div class="mb-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark"><i class="fa-solid fa-shield-halved text-danger me-2"></i>Paquetes de Prevención Oncología</h3>
                <p class="text-muted">Estudios especializados orientados a la detección temprana y cuidado integral.</p>
            </div>

            <div class="row g-4">

                <!-- Oferta Cáncer 1: Marcadores Tumorales Femeninos -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                        <span class="position-absolute top-0 end-0 bg-danger text-white px-3 py-1 rounded-bl fw-bold fs-6" style="border-bottom-left-radius: 12px;">-50% OFF</span>
                        <div class="p-4 bg-danger-subtle text-danger text-center">
                            <i class="fa-solid fa-ribbon fa-4x"></i>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="fw-bold text-dark">Perfil Prevención Rosa (Femenino)</h5>
                            <p class="text-muted small">Incluye Marcadores CA 15-3 (Mama), CA 125 (Ovario) y CEA (Antígeno Carcinoembrionario).</p>
                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-decoration-line-through text-muted small">$1,800 MXN</span>
                                    <h4 class="fw-bold text-success m-0">$900 MXN</h4>
                                </div>
                                <a href="citas.php" class="btn btn-primary rounded-pill px-3">Agendar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Oferta Cáncer 2: Salud Prostática -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                        <span class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-bl fw-bold fs-6" style="border-bottom-left-radius: 12px;">2x1 PROSTÁTICO</span>
                        <div class="p-4 bg-primary-subtle text-primary text-center">
                            <i class="fa-solid fa-user-shield fa-4x"></i>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="fw-bold text-dark">Perfil Salud Masculina / Próstata</h5>
                            <p class="text-muted small">Antígeno Prostático Específico (PSA Total y Libre) + Examen General de Orina.</p>
                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-decoration-line-through text-muted small">$950 MXN</span>
                                    <h4 class="fw-bold text-success m-0">$475 MXN</h4>
                                </div>
                                <a href="citas.php" class="btn btn-primary rounded-pill px-3">Agendar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Oferta Cáncer 3: Detección VPH / Papanicolaou -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                        <span class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 rounded-bl fw-bold fs-6" style="border-bottom-left-radius: 12px;">PREVENCIÓN</span>
                        <div class="p-4 bg-warning-subtle text-warning-emphasis text-center">
                            <i class="fa-solid fa-dna fa-4x"></i>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="fw-bold text-dark">Detección y Papanicolaou</h5>
                            <p class="text-muted small">Estudio ginecológico preventivo para detección oportuna de alteraciones celulares y VPH.</p>
                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-decoration-line-through text-muted small">$700 MXN</span>
                                    <h4 class="fw-bold text-success m-0">$350 MXN</h4>
                                </div>
                                <a href="citas.php" class="btn btn-primary rounded-pill px-3">Agendar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <hr class="my-5">

        <!-- OTRAS OFERTAS Y CHECK-UPS GENERALES -->
        <div class="mb-4 text-center">
            <h3 class="fw-bold text-dark">Más Promociones Generales</h3>
            <p class="text-muted">Aprovecha también los descuentos en nuestros análisis clínicos cotidianos.</p>
        </div>

        <div class="row g-4">

            <!-- Oferta Check-up Básico -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                    <span class="position-absolute top-0 end-0 bg-danger text-white px-3 py-1 rounded-bl fw-bold fs-6" style="border-bottom-left-radius: 12px;">-40% OFF</span>
                    <div class="p-4 bg-light text-primary text-center">
                        <i class="fa-solid fa-notes-medical fa-4x"></i>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="fw-bold text-dark">Check-up General Básico</h5>
                        <p class="text-muted small">Incluye Biometría Hemática, Glucosa, Colesterol, Triglicéridos y Examen de Orina.</p>
                        <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-decoration-line-through text-muted small">$800 MXN</span>
                                <h4 class="fw-bold text-success m-0">$480 MXN</h4>
                            </div>
                            <a href="citas.php" class="btn btn-primary rounded-pill px-3">Agendar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Oferta Control de Glucosa -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                    <span class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 rounded-bl fw-bold fs-6" style="border-bottom-left-radius: 12px;">COMBO</span>
                    <div class="p-4 bg-light text-success text-center">
                        <i class="fa-solid fa-cubes-stacked fa-4x"></i>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="fw-bold text-dark">Perfil Control de Glucosa</h5>
                        <p class="text-muted small">Ideal para prevención y seguimiento. Incluye Glucosa en ayuno y Hemoglobina Glucosilada.</p>
                        <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-decoration-line-through text-muted small">$650 MXN</span>
                                <h4 class="fw-bold text-success m-0">$390 MXN</h4>
                            </div>
                            <a href="citas.php" class="btn btn-primary rounded-pill px-3">Agendar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                    <span class="position-absolute top-0 end-0 bg-info text-white px-3 py-1 rounded-bl fw-bold fs-6" style="border-bottom-left-radius: 12px;">SENIOR</span>
                    <div class="p-4 bg-light text-info-emphasis text-center">
                        <i class="fa-solid fa-person-cane fa-4x"></i>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="fw-bold text-dark">Check-up Adulto Mayor</h5>
                        <p class="text-muted small">Estudio completo diseñado para la salud de nuestros abuelitos. Incluye atención prioritaria.</p>
                        <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-decoration-line-through text-muted small">$1,100 MXN</span>
                                <h4 class="fw-bold text-success m-0">$550 MXN</h4>
                            </div>
                            <a href="citas.php" class="btn btn-primary rounded-pill px-3">Agendar</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- PIE DE PÁGINA -->
    <footer class="bg-primary text-white py-4 mt-auto text-center shadow-sm">
        <div class="container">
            <p class="mb-0 small text-white-50">&copy; 2026 Laboratorios Buenfil web. Todos los derechos reservados (No se la roben porfabor).</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>