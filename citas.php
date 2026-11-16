<?php
session_start();
include 'conexion.php'; // Asegúrate de que este sea tu archivo de conexión

if (!isset($_SESSION['usuario_id'])) {
    echo "<script>
            alert('Por favor, inicia sesión o regístrate para poder agendar una cita.');
            window.location='login.php';
          </script>";
    exit();
}

// Obtenemos el correo del usuario logueado usando PDO
$id_usr = $_SESSION['usuario_id'];
$stmt_usr = $conexion->prepare("SELECT correo FROM usuario WHERE id = :id");
$stmt_usr->bindParam(':id', $id_usr, PDO::PARAM_INT);
$stmt_usr->execute();
$datos_usr = $stmt_usr->fetch(PDO::FETCH_ASSOC);
$correo_usuario = $datos_usr ? $datos_usr['correo'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios Buenfil web - Agendar Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <span class="text-white me-3 small">
                            <i class="fa-solid fa-user-doctor me-1"></i> Hola, <strong><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></strong>
                        </span>
                        <a class="btn btn-outline-light rounded-pill px-3" href="logout.php">
                            <i class="fa-solid fa-right-from-bracket me-1"></i> Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL: AGENDAR CITAS -->
    <main class="container my-5">
        <div class="card shadow border-0 rounded-4 p-4 p-md-5 bg-white mb-5">
            
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
                
                <!-- COLUMNA IZQUIERDA: PASO A PASO -->
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
                            <i class="fa-solid fa-circle-info me-1"></i> Si necesitas cancelar tu cita, hazlo desde la sección inferior.
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
                                        <option value="Examen general de orina (EGO)">Examen general de orina (EGO)</option>
                                        <option value="Pruebas de dengue">Pruebas de dengue</option>
                                        <option value="Pruebas de VIH">Pruebas de VIH</option>
                                        <option value="Prueba de embarazo">Prueba de embarazo</option>
                                        <option value="Quimica sanguinea">Quimica sanguinea</option>
                                        <option value="Biometrica hemática">Biometrica hemática</option>
                                        <option value="Perfil de lípidos">Perfil de lípidos</option>
                                        <option value="Análisis de electrilitos">Análisis de electrilitos</option>
                                        <option value="Reacciones febriles">Reacciones febriles</option>
                                        <option value="Hemoglobina glucosilada">Hemoglobina glucosilada</option>
                                        <option value="Pruebas de función hepática">Pruebas de función hepática</option>
                                        <option value="Perfil ginecólogo">Perfil ginecólogo</option>
                                        <option value="Perfil tiroideo">Perfil tiroideo</option>
                                        <option value="Papanicolau">Papanicolau</option>
                                        <option value="Perfil hormonal masculino">Perfil hormonal masculino</option>
                                        <option value="Antígeno prostático especifico">Antígeno prostático especifico</option>
                                        <option value="Antígeno Prostático libre">Antígeno Prostático libre</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- FECHA Y HORA -->
                        <div class="card border mb-4 rounded-3 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="fa-regular fa-calendar me-2"></i> 2. Elige la fecha y hora
                                </h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="form-label text-muted small fw-bold">Fecha *</label>
                                        <input type="date" class="form-control" name="fecha" min="<?php echo date('Y-m-d'); ?>" required>
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

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="index.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                                <i class="fa-solid fa-calendar-check me-2"></i> Confirmar cita
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <!-- SECCIÓN: MIS CITAS EN ESPERA -->
        <div class="card shadow border-0 rounded-4 p-4 p-md-5 bg-white">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-primary-subtle text-primary p-3 rounded-circle me-3">
                    <i class="fa-solid fa-clock fa-2x"></i>
                </div>
                <div>
                    <h3 class="fw-bold text-dark m-0">Mis Citas en Espera</h3>
                    <p class="text-muted m-0">Visualiza las citas que has agendado y cancélalas si lo necesitas.</p>
                </div>
            </div>

            <?php
            $stmt = $conexion->prepare("SELECT id, estudio, fecha, hora, estado FROM citas WHERE correo = :correo ORDER BY fecha DESC");
            $stmt->bindParam(':correo', $correo_usuario, PDO::PARAM_STR);
            $stmt->execute();
            $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php if (count($citas) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Estudio Clínico</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($citas as $cita): ?>
                                <tr>
                                    <td class="fw-semibold text-dark"><?php echo htmlspecialchars($cita['estudio']); ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($cita['fecha'])); ?></td>
                                    <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                                    <td>
                                        <?php if (isset($cita['estado']) && $cita['estado'] === 'Cancelada'): ?>
                                            <span class="badge bg-danger">Cancelada</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">En espera</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if (!isset($cita['estado']) || $cita['estado'] !== 'Cancelada'): ?>
                                            <!-- Botón que activa el Modal estilo Admin -->
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#confirmModal" 
                                                    data-id="<?php echo $cita['id']; ?>"
                                                    data-estudio="<?php echo htmlspecialchars($cita['estudio']); ?>">
                                                <i class="fa-solid fa-xmark me-1"></i> Cancelar cita
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted small fst-italic">Sin acciones</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">
                    <i class="fa-regular fa-calendar-xmark fa-3x mb-3 text-secondary opacity-50"></i>
                    <p class="mb-0">Aún no tienes citas registradas.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- MODAL DE ADVERTENCIA ANTI-MISCLICKS (Estilo Admin) -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-danger text-white rounded-top-4">
                    <h5 class="modal-title fw-bold" id="confirmModalLabel">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>Confirmar Cancelación de Cita
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted mb-2">Estás a punto de cancelar tu cita para el siguiente estudio:</p>
                    <div class="alert alert-light border p-3 rounded-3 mb-3">
                        <strong>Estudio:</strong> <span id="modalEstudio" class="text-danger fw-bold"></span>
                    </div>
                    <p class="small text-danger fw-medium mb-2">Para confirmar, escribe la palabra <strong class="text-dark">CANCELAR</strong> en el siguiente campo:</p>
                    <input type="text" id="confirmInputText" class="form-control" placeholder="Escribe CANCELAR aquí..." autocomplete="off">
                </div>
                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Regresar</button>
                    <!-- El botón de acción inicia deshabilitado -->
                    <a id="btnConfirmarAccion" href="#" class="btn btn-danger rounded-pill px-4 disabled">
                        <i class="fa-solid fa-ban me-1"></i> Sí, cancelar cita
                    </a>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Bootstrap JS y Script dinámico para el Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const confirmModal = document.getElementById('confirmModal');
        confirmModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const estudio = button.getAttribute('data-estudio');
            
            document.getElementById('modalEstudio').textContent = estudio;
            
            const btnConfirmar = document.getElementById('btnConfirmarAccion');
            btnConfirmar.href = 'cancelar_cita.php?id=' + id;
            
            const inputTxt = document.getElementById('confirmInputText');
            inputTxt.value = '';
            btnConfirmar.classList.add('disabled');
        });

        const inputTxt = document.getElementById('confirmInputText');
        const btnConfirmar = document.getElementById('btnConfirmarAccion');
        
        inputTxt.addEventListener('input', function() {
            if (this.value.trim().toUpperCase() === 'CANCELAR') {
                btnConfirmar.classList.remove('disabled');
            } else {
                btnConfirmar.classList.add('disabled');
            }
        });
    </script>
</body>
</html>