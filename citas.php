<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios Buenfil web - Agendar Citas</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

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
                    <li class="nav-item"><a class="nav-link active" href="citas.php">CONSULTAS</a></li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-light rounded-pill px-3" href="registro.php">
                            <i class="fa-regular fa-user me-1"></i> Mi Cuenta
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL: AGENDAR CITAS -->
    <main class="container my-5">
        <div class="card shadow border-0 rounded-4 p-4 p-md-5 bg-white">
            
            <!-- Encabezado de la sección -->
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-primary-subtle text-primary p-3 rounded-circle me-3">
                    <i class="fa-solid fa-calendar-check fa-2x"></i>
                </div>
                <div>
                    <h2 class="fw-bold text-dark m-0">Agendar Citas</h2>
                    <p class="text-muted m-0">Selecciona el estudio, la fecha y el horario que mejor se adapte a ti.</p>
                </div>
            </div>

            <div class="row g-4">
                
                <!-- COLUMNA IZQUIERDA: PASO A PASO (Diseño Guía) -->
                <div class="col-lg-4">
                    <div class="bg-light p-4 rounded-4 border h-100">
                        <h5 class="fw-bold text-dark mb-4"><i class="fa-solid fa-list-ol me-2 text-primary"></i>Paso a paso</h5>
                        
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex align-items-start mb-3">
                                <span class="badge bg-primary rounded-circle p-2 me-3 mt-1">1</span>
                                <small class="text-secondary">Selecciona el estudio que necesitas.</small>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <span class="badge bg-secondary rounded-circle p-2 me-3 mt-1">2</span>
                                <small class="text-secondary">Elige la fecha y hora disponible.</small>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <span class="badge bg-secondary rounded-circle p-2 me-3 mt-1">3</span>
                                <small class="text-secondary">Confirma tu cita.</small>
                            </li>
                            <li class="d-flex align-items-start">
                                <span class="badge bg-secondary rounded-circle p-2 me-3 mt-1">4</span>
                                <small class="text-secondary">Recibirás un correo con los detalles de tu cita.</small>
                            </li>
                        </ul>

                        <div class="alert alert-info border-0 p-3 small mb-0 rounded-3">
                            <i class="fa-solid fa-circle-info me-1"></i> Si necesitas cancelar tu cita,favor de hacerlo con tiempo de antelacíon".
                        </div>
                    </div>
                </div>

                <!-- COLUMNA DERECHA: FORMULARIO DE AGENDADO -->
                <div class="col-lg-8">
                    <form action="procesar_cita.php" method="POST">
                        
                        <!-- SECCIÓN 1: ESTUDIO -->
                        <div class="card border mb-4 rounded-3 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="fa-solid fa-flask me-2"></i> 1. Selecciona el estudio
                                </h6>
                                <div class="mb-0">
                                    <label class="form-label text-muted small fw-bold">Estudio o análisis clínico *</label>
                                    <select class="form-select" name="estudio" required>
                                        <option value="" selected disabled>Selecciona un estudio</option>
                                        <option value="perfil_lipidico">Biometria Hemática</option>
                                        <option value="glucosa">Prueba de VIH</option>
                                        <option value="orina">Examen general de orina</option>
                                        <option value="biometria">Prueba de embarazo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- FECHA Y HORA DE LA CONSULTA,obvio no siempre esta disponible-->
                        <div class="card border mb-4 rounded-3 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="fa-regular fa-calendar me-2"></i> 2. Elige la fecha y hora
                                </h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="form-label text-muted small fw-bold">Fecha *</label>
                                        <input type="date" class="form-control" name="fecha" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Hora *</label>
                                        <select class="form-select" name="hora" required>
                                            <option value="" selected disabled>Selecciona un horario</option>
                                            <option value="08:00">08:00 AM</option>
                                            <option value="09:30">09:30 AM</option>
                                            <option value="11:00">11:00 AM</option>
                                            <option value="01:00">01:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--DATOS DEL PACIENTE -->
                        <div class="card border mb-4 rounded-3 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="fa-regular fa-user me-2"></i> 3. Datos del paciente
                                </h6>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Nombre completo *</label>
                                    <input type="text" class="form-control" name="nombre_completo" placeholder="Ingresa tu nombre completo" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="form-label text-muted small fw-bold">Teléfono celular *</label>
                                        <input type="tel" class="form-control" name="telefono" placeholder="Ingresa tu número de celular" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Correo electrónico *</label>
                                        <input type="email" class="form-control" name="correo" placeholder="Ingresa tu correo electrónico" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="index.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                                <i class="fa-solid fa-calendar-check me-2"></i> Confirmar cita
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </main>

    <!-- PIE DE PÁGINA -->
    <footer class="bg-white border-top py-4 mt-auto text-muted">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="mb-2 mb-md-0 small">&copy; 2026 Laboratorios Buenfil web. Todos los derechos reservados.</p>
            <div>
                <a href="#" class="text-muted text-decoration-none small me-3">Términos y condiciones</a>
                <a href="#" class="text-muted text-decoration-none small me-3">Aviso de privacidad</a>
                <a href="#" class="text-muted text-decoration-none small">Contacto</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>