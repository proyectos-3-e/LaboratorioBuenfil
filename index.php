<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios Buenfil Website - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
   
    <!-- NAVBAR -->
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
                    <li class="nav-item"><a class="nav-link active" href="index.php">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="promociones.php">DESCUENTOS Y PROMOCIONES</a></li>
                    <li class="nav-item"><a class="nav-link" href="citas.php">CONSULTAS</a></li>

                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <?php if (isset($_SESSION['nombre_usuario']) || isset($_SESSION['rol'])): ?>
                            <span class="text-white me-2 small">
                                <i class="fa-solid fa-user-circle me-1"></i> Hola, <strong><?php echo htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario'); ?></strong>
                            </span>

                            <!-- ROL: ADMIN / MÉDICO -->
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                                <a class="btn btn-warning btn-sm rounded-pill px-3 fw-bold me-2 text-dark shadow-sm" href="admin.php">
                                    <i class="fa-solid fa-shield-halved me-1"></i> Citas
                                </a>
                            <?php endif; ?>

                            <!-- ROL: LABORATORISTA -->
                            <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] === 'laboratorista' || $_SESSION['rol'] === 'Lab')): ?>
                                <a class="btn btn-success btn-sm rounded-pill px-3 fw-bold me-2 text-white shadow-sm" href="panel_laboratorista.php">
                                    <i class="fa-solid fa-microscope me-1"></i> Actualizar Resultados
                                </a>
                            <?php endif; ?>

                            <!-- ROL: PACIENTE / USUARIO -->
                            <?php if (!isset($_SESSION['rol']) || $_SESSION['rol'] === 'paciente' || $_SESSION['rol'] === 'usuario'): ?>
                                <a class="btn btn-info btn-sm rounded-pill px-3 fw-bold me-2 text-white shadow-sm" href="mis_resultados.php">
                                    <i class="fa-solid fa-file-medical me-1"></i> Resultados
                                </a>
                            <?php endif; ?>

                            <a class="btn btn-outline-light rounded-pill px-3 btn-sm" href="logout.php">
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

    <!-- SECCIÓN HERO (BIENVENIDA Y OFERTAS) -->
    <main class="container my-5">
        <div class="row align-items-center g-4 mb-5">
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

        <!-- ESTUDIOS FRECUENTES -->
        <div class="mb-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Estudios y Análisis Frecuentes</h2>
                <p class="text-muted">Conoce algunos de los estudios clínicos más solicitados por nuestros pacientes.</p>
            </div>
            
            <!-- 3 Estudios principales -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="bg-primary-subtle text-primary p-4 text-center">
                            <i class="fa-solid fa-droplet fa-3x"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Biometría Hemática</h5>
                            <p class="text-muted small">Análisis completo de los componentes de la sangre para evaluar tu estado de salud general.</p>
                            <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="bg-success-subtle text-success p-4 text-center">
                            <i class="fa-solid fa-flask-vial fa-3x"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Examen General de Orina</h5>
                            <p class="text-muted small">Prueba diagnóstica fundamental para detectar infecciones o problemas renales a tiempo.</p>
                            <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="bg-warning-subtle text-warning-emphasis p-4 text-center">
                            <i class="fa-solid fa-heart-pulse fa-3x"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Pruebas Especiales</h5>
                            <p class="text-muted small">Contamos con perfiles especializados y pruebas de embarazo con resultados confiables.</p>
                            <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estudios adicionales desplegables -->
            <div class="collapse mt-4" id="estudiosExtra">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-danger-subtle text-danger p-4 text-center">
                                <i class="fa-solid fa-mosquito fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Pruebas de dengue</h5>
                                <p class="text-muted small">Detección oportuna de anticuerpos o antígenos relacionados con el virus del dengue.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-info-subtle text-info-emphasis p-4 text-center">
                                <i class="fa-solid fa-shield-virus fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Pruebas de VIH</h5>
                                <p class="text-muted small">Estudio confidencial y seguro para la detección de anticuerpos contra el VIH.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-primary-subtle text-primary p-4 text-center">
                                <i class="fa-solid fa-baby fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Prueba de embarazo</h5>
                                <p class="text-muted small">Análisis cualitativo o cuantitativo de la hormona gonadotropina coriónica humana.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-success-subtle text-success p-4 text-center">
                                <i class="fa-solid fa-vials fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Química sanguínea</h5>
                                <p class="text-muted small">Mide los niveles de glucosa, urea, creatinina y otros elementos metabólicos esenciales.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-warning-subtle text-warning-emphasis p-4 text-center">
                                <i class="fa-solid fa-fire fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Perfil de lípidos</h5>
                                <p class="text-muted small">Evaluación detallada de colesterol total, HDL, LDL y triglicéridos.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-secondary-subtle text-secondary p-4 text-center">
                                <i class="fa-solid fa-bolt fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Análisis de electrólitos</h5>
                                <p class="text-muted small">Control de sodio, potasio y cloro para mantener el balance hídrico y celular.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-danger-subtle text-danger p-4 text-center">
                                <i class="fa-solid fa-temperature-high fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Reacciones febriles</h5>
                                <p class="text-muted small">Pruebas serológicas de apoyo para la detección de enfermedades infecciosas febriles.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-primary-subtle text-primary p-4 text-center">
                                <i class="fa-solid fa-chart-line fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Hemoglobina glucosilada</h5>
                                <p class="text-muted small">Indicador clave del control promedio de los niveles de azúcar en la sangre.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-success-subtle text-success p-4 text-center">
                                <i class="fa-solid fa-notes-medical fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Pruebas de función hepática</h5>
                                <p class="text-muted small">Evalúa enzimas y proteínas esenciales para conocer el estado de salud del hígado.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-warning-subtle text-warning-emphasis p-4 text-center">
                                <i class="fa-solid fa-venus fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Perfil ginecológico</h5>
                                <p class="text-muted small">Estudio enfocado en el monitoreo hormonal y el bienestar integral de la mujer.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-info-subtle text-info-emphasis p-4 text-center">
                                <i class="fa-solid fa-dna fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Perfil tiroideo</h5>
                                <p class="text-muted small">Medición de hormonas clave para verificar la función de la glándula tiroides.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-primary-subtle text-primary p-4 text-center">
                                <i class="fa-solid fa-file-medical fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Papanicolau</h5>
                                <p class="text-muted small">Prueba citológica orientada a la prevención y detección oportuna de alteraciones.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-secondary-subtle text-secondary p-4 text-center">
                                <i class="fa-solid fa-mars fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Perfil hormonal masculino</h5>
                                <p class="text-muted small">Evaluación de niveles hormonales enfocados en la salud y vitalidad del hombre.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-success-subtle text-success p-4 text-center">
                                <i class="fa-solid fa-user-shield fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Antígeno prostático específico</h5>
                                <p class="text-muted small">Marcador clave utilizado para la prevención y seguimiento de la salud prostática.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="bg-warning-subtle text-warning-emphasis p-4 text-center">
                                <i class="fa-solid fa-user-check fa-3x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">Antígeno prostático libre</h5>
                                <p class="text-muted small">Estudio complementario para un diagnóstico más preciso en la salud de la próstata.</p>
                                <a href="citas.php" class="btn btn-outline-primary btn-sm w-100">Agendar este estudio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón "Ver más" desplegable con ID para cambiar texto -->
            <div class="row mt-4">
                <div class="col-12">
                    <button class="btn btn-outline-primary w-100 rounded-pill py-2 shadow-sm fw-bold" 
                            id="btnVerMas"
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#estudiosExtra" 
                            aria-expanded="false" 
                            aria-controls="estudiosExtra">
                        Ver más
                    </button>
                </div>
            </div>
        </div>

        <!-- ¿POR QUÉ ELEGIRNOS? -->
        <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <h3 class="fw-bold text-primary mb-3">Comprometidos con la precisión y tu bienestar</h3>
                    <p class="text-muted">En Laboratorios Buenfil utilizamos tecnología de vanguardia y personal altamente capacitado para garantizar diagnósticos confiables y seguros.</p>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i> Resultados rápidos y digitales</li>
                        <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i> Equipos automatizados de alta precisión</li>
                        <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i> Instalaciones cómodas e higiénicas</li>
                    </ul>
                </div>
                <div class="col-md-6 text-center">
                    <div class="p-5 bg-light rounded-4 border text-muted">
                        <i class="fa-regular fa-image fa-3x mb-2 text-primary"></i>
                        <p class="small m-0">Espacio reservado para foto del laboratorio o equipo médico</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONOCE A NUESTROS ESPECIALISTAS -->
        <div class="mb-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Conoce a nuestros Especialistas</h2>
                <p class="text-muted">Profesionales de la salud comprometidos con la calidad y calidez en tu atención.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-3">
                        <div class="bg-light rounded-circle mx-auto mt-3 d-flex align-items-center justify-content-center text-primary" style="width: 120px; height: 120px;">
                            <i class="fa-solid fa-user-doctor fa-4x"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark mb-1">Dr. Roberto Buenfil</h5>
                            <p class="text-primary small fw-bold mb-2">Director Médico & Patólogo Clínico</p>
                            <p class="text-muted small">Especialista en análisis clínicos con más de 15 años de trayectoria asegurando diagnósticos precisos.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-3">
                        <div class="bg-light rounded-circle mx-auto mt-3 d-flex align-items-center justify-content-center text-primary" style="width: 120px; height: 120px;">
                            <i class="fa-solid fa-user-nurse fa-4x"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark mb-1">Dra. Kim</h5>
                            <p class="text-primary small fw-bold mb-2">Químico Farmacéutico Biólogo</p>
                            <p class="text-muted small">Encargada del área de bacteriología y control de calidad en procesos de muestras sanguíneas.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-3">
                        <div class="bg-light rounded-circle mx-auto mt-3 d-flex align-items-center justify-content-center text-primary" style="width: 120px; height: 120px;">
                            <i class="fa-solid fa-user-tie fa-4x"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark mb-1">Lic. Bowie</h5>
                            <p class="text-primary small fw-bold mb-2">Atención al Paciente y Citas</p>
                            <p class="text-muted small">Especialista en orientación médica y gestión de resultados digitales para toda la familia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NUEVA SECCIÓN: CONOCE NUESTRAS OFICINAS Y INSTALACIONES -->
        <div class="mb-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Nuestras Oficinas y Sucursales</h2>
                <p class="text-muted">Visítanos en nuestras instalaciones equipadas con la mejor tecnología.</p>
            </div>

            <div class="row g-4 align-items-stretch">
                <!-- Tarjeta con Información de la Oficina -->
                <div class="col-lg-5">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-4 bg-white">
                        <h4 class="fw-bold text-primary mb-3">
                            <i class="fa-solid fa-building-user me-2"></i>Matriz El Mante
                        </h4>
                        <p class="text-muted small mb-4">Atención cálida, rápida e instalaciones sanitizadas diariamente.</p>

                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary-subtle text-primary p-2 rounded-3 me-3">
                                <i class="fa-solid fa-location-dot fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Dirección:</h6>
                                <p class="text-secondary small mb-0">Zona Centro, El Mante, Tamaulipas, C.P. 89800</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary-subtle text-primary p-2 rounded-3 me-3">
                                <i class="fa-solid fa-clock fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Horario de Atención:</h6>
                                <p class="text-secondary small mb-0">Lunes a Viernes: 7:00 AM - 7:00 PM</p>
                                <p class="text-secondary small mb-0">Sábados: 7:00 AM - 2:00 PM</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary-subtle text-primary p-2 rounded-3 me-3">
                                <i class="fa-solid fa-phone fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Teléfono / WhatsApp:</h6>
                                <p class="text-secondary small mb-0">+52 (831) 123-4567</p>
                            </div>
                        </div>

                        <a href="citas.php" class="btn btn-primary w-100 py-2 rounded-3 fw-bold">
                            <i class="fa-regular fa-calendar-check me-2"></i> Agendar cita en esta sucursal
                        </a>
                    </div>
                </div>

                <!-- Galería de Fotos de las Oficinas / Recepción -->
                <div class="col-lg-7">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-3 bg-white">
                        <div class="row g-3 h-100">
                            <!-- Foto 1: Recepción -->
                            <div class="col-md-6">
                                <div class="bg-light rounded-4 h-100 d-flex flex-column align-items-center justify-content-center p-4 text-center border text-muted">
                                    <i class="fa-solid fa-hospital-user fa-3x text-primary mb-2"></i>
                                    <h6 class="fw-bold text-dark">Recepción y Sala de Espera</h6>
                                    <p class="small mb-0">Espacios cómodos y climatizados para tu tranquilidad.</p>
                                </div>
                            </div>
                            <!-- Foto 2: Área de Toma de Muestras -->
                            <div class="col-md-6">
                                <div class="bg-light rounded-4 h-100 d-flex flex-column align-items-center justify-content-center p-4 text-center border text-muted">
                                    <i class="fa-solid fa-microscope fa-3x text-primary mb-2"></i>
                                    <h6 class="fw-bold text-dark">Área de Toma de Muestras</h6>
                                    <p class="small mb-0">Cubículos privados y material 100% estéril y desechable.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-top py-4 mt-auto text-center text-muted">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 Laboratorios Buenfil web. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para cambiar el texto del botón dinámicamente -->
    <script>
        const sucursalCollapse = document.getElementById('estudiosExtra');
        const btnVerMas = document.getElementById('btnVerMas');

        sucursalCollapse.addEventListener('show.bs.collapse', function () {
            btnVerMas.textContent = 'Ver menos';
        });

        sucursalCollapse.addEventListener('hide.bs.collapse', function () {
            btnVerMas.textContent = 'Ver más';
        });
    </script>
</body>
</html>