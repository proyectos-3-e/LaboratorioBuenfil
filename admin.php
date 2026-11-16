<?php
session_start();
include("conexion.php");

// Validar que la sesión sea de un Administrador
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    echo "<script>
            alert('Acceso denegado. Área exclusiva para personal médico/administrativo.');
            window.location='login.php';
          </script>";
    exit();
}

try {
    // 1. Citas Pendientes (En espera)
    $stmtPendientes = $conexion->query("SELECT * FROM citas WHERE estado = 'En espera' ORDER BY id DESC");
    $citasPendientes = $stmtPendientes->fetchAll(PDO::FETCH_ASSOC);

    // 2. Citas Atendidas (Historial)
    $stmtAtendidas = $conexion->query("SELECT * FROM citas WHERE estado = 'Atendida' ORDER BY id DESC");
    $citasAtendidas = $stmtAtendidas->fetchAll(PDO::FETCH_ASSOC);

    // 3. Datos generales para la Gráfica Chart.js (histórico completo)
    $stmtGrafica = $conexion->query("SELECT estudio, COUNT(*) as total FROM citas GROUP BY estudio");
    $datosGrafica = $stmtGrafica->fetchAll(PDO::FETCH_ASSOC);

    $nombresEstudios = [];
    $totalesEstudios = [];

    foreach ($datosGrafica as $row) {
        $nombresEstudios[] = $row['estudio'];
        $totalesEstudios[] = $row['total'];
    }

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorios Buenfil web - Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f8f9fa !important; }
        .navbar-buenfil { background-color: #0d6efd !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-buenfil shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="bg-white text-primary p-2 rounded-3 me-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
                    <i class="fa-solid fa-flask fa-lg"></i>
                </div>
                <span class="fw-bold fs-5">Laboratorios Buenfil web</span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link text-white fw-medium px-3" href="index.php">INICIO</a></li>
                    <li class="nav-item ms-lg-3">
                        <span class="text-white me-3 small">
                            <i class="fa-solid fa-user me-1"></i> Hola, <strong><?php echo htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Dr. Medico'); ?></strong>
                        </span>
                        <a class="btn btn-outline-light rounded-pill px-4 btn-sm fw-medium" href="logout.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        
        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
            <div class="bg-primary text-white p-3 rounded-circle me-3 shadow-sm">
                <i class="fa-solid fa-database fa-2x"></i>
            </div>
            <div>
                <h2 class="fw-bold text-dark m-0">Gestión de citas médicas</h2>
                <p class="text-muted m-0">Visualización, control y estadísticas generales del laboratorio.</p>
            </div>
        </div>

        <!-- TABLA 1: CITAS PENDIENTES -->
        <div class="card shadow-sm border-0 rounded-4 p-4 bg-white mb-5">
            <div class="row align-items-center mb-4 g-3">
                <div class="col-md-6">
                    <h4 class="fw-bold text-primary m-0">
                        <i class="fa-solid fa-calendar-check me-2"></i>Citas Pendientes (En espera)
                    </h4>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" id="busquedaInput" class="form-control border-start-0 rounded-end-pill py-2" placeholder="Buscar por paciente, estudio o correo..." autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted small">Citas activas que requieren atención médica.</span>
                <span class="badge bg-primary rounded-pill px-3 py-2"><?php echo count($citasPendientes); ?> Pendientes</span>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="tablaCitas">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>ID</th>
                            <th>Estudio / Análisis</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Paciente</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($citasPendientes) > 0): ?>
                            <?php foreach ($citasPendientes as $cita): ?>
                                <tr>
                                    <td><strong>#<?php echo $cita['id']; ?></strong></td>
                                    <td><span class="badge bg-primary-subtle text-primary border border-primary fw-bold"><?php echo htmlspecialchars($cita['estudio']); ?></span></td>
                                    <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                                    <td class="fw-bold"><?php echo htmlspecialchars($cita['nombre_completo']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['telefono']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['correo']); ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmModal" 
                                                data-id="<?php echo $cita['id']; ?>"
                                                data-paciente="<?php echo htmlspecialchars($cita['nombre_completo']); ?>"
                                                data-estudio="<?php echo htmlspecialchars($cita['estudio']); ?>">
                                            <i class="fa-solid fa-check-double me-1"></i> Atendida
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr id="filaNoResultados">
                                <td colspan="8" class="text-center text-muted py-4">No hay citas pendientes en este momento.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABLA 2: HISTORIAL DE CITAS ATENDIDAS -->
        <div class="card shadow-sm border-0 rounded-4 p-4 bg-white mb-5 border-top border-success border-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-success m-0">
                    <i class="fa-solid fa-clipboard-user me-2"></i>Historial de Citas Atendidas
                </h4>
                <div>
                    <span class="badge bg-success rounded-pill px-3 py-2 me-2"><?php echo count($citasAtendidas); ?> Registradas</span>
                    <?php if (count($citasAtendidas) > 0): ?>
                        <a href="limpiar_atendidas.php" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('¿Estás seguro de limpiar todo el historial de citas atendidas?');">
                            <i class="fa-solid fa-trash-can me-1"></i> Limpiar apartado
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <p class="text-muted small">Registro de pacientes que ya fueron atendidos en el laboratorio.</p>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-success text-dark">
                        <tr>
                            <th>ID</th>
                            <th>Estudio / Análisis</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Paciente</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($citasAtendidas) > 0): ?>
                            <?php foreach ($citasAtendidas as $cita): ?>
                                <tr>
                                    <td><strong>#<?php echo $cita['id']; ?></strong></td>
                                    <td><span class="badge bg-success-subtle text-success border border-success fw-bold"><?php echo htmlspecialchars($cita['estudio']); ?></span></td>
                                    <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                                    <td class="fw-bold"><?php echo htmlspecialchars($cita['nombre_completo']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['telefono']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['correo']); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-success rounded-pill px-3">Atendida</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No hay historial de citas atendidas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- GRÁFICA GENERAL (UBICADA AL FINAL) -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
                    <h5 class="fw-bold text-primary mb-3 text-center">
                        <i class="fa-solid fa-chart-pie me-2"></i>Estadística General (Histórico de Estudios)
                    </h5>
                    <div style="position: relative; height: 280px; width: 100%;">
                        <canvas id="graficaEstudios"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- MODAL ANTI-MISCLICKS -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title fw-bold" id="confirmModalLabel">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>Confirmar Cita Atendida
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted mb-2">Estás a punto de marcar como atendida la cita de:</p>
                    <div class="alert alert-light border p-3 rounded-3 mb-3">
                        <strong>Paciente:</strong> <span id="modalPaciente" class="text-primary"></span><br>
                        <strong>Estudio:</strong> <span id="modalEstudio" class="text-secondary"></span>
                    </div>
                    <p class="small text-danger fw-medium mb-2">Para confirmar, escribe la palabra <strong class="text-dark">ATENDIDA</strong> en el siguiente campo:</p>
                    <input type="text" id="confirmInputText" class="form-control" placeholder="Escribe ATENDIDA aquí..." autocomplete="off">
                </div>
                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                    <a id="btnConfirmarAccion" href="#" class="btn btn-success rounded-pill px-4 disabled">
                        <i class="fa-solid fa-check me-1"></i> Sí, marcar como atendida
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-top py-4 mt-auto text-muted text-center">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 Laboratorios Buenfil web. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ctx = document.getElementById('graficaEstudios').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nombresEstudios); ?>,
                datasets: [{
                    label: 'Total histórico solicitado',
                    data: <?php echo json_encode($totalesEstudios); ?>,
                    backgroundColor: ['rgba(13, 110, 253, 0.7)', 'rgba(25, 135, 84, 0.7)', 'rgba(255, 193, 7, 0.7)', 'rgba(220, 53, 69, 0.7)', 'rgba(111, 66, 193, 0.7)'],
                    borderWidth: 1,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });

        const confirmModal = document.getElementById('confirmModal');
        confirmModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            document.getElementById('modalPaciente').textContent = button.getAttribute('data-paciente');
            document.getElementById('modalEstudio').textContent = button.getAttribute('data-estudio');
            document.getElementById('btnConfirmarAccion').href = 'marcar_atendida.php?id=' + button.getAttribute('data-id');
            document.getElementById('confirmInputText').value = '';
            document.getElementById('btnConfirmarAccion').classList.add('disabled');
        });

        document.getElementById('confirmInputText').addEventListener('input', function() {
            const btn = document.getElementById('btnConfirmarAccion');
            if (this.value.trim().toUpperCase() === 'ATENDIDA') {
                btn.classList.remove('disabled');
            } else {
                btn.classList.add('disabled');
            }
        });

        const busquedaInput = document.getElementById('busquedaInput');
        const filas = document.getElementById('tablaCitas').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        busquedaInput.addEventListener('keyup', function() {
            const texto = busquedaInput.value.toLowerCase();
            for (let i = 0; i < filas.length; i++) {
                if (filas[i].id === 'filaNoResultados') continue;
                filas[i].style.display = filas[i].textContent.toLowerCase().indexOf(texto) > -1 ? "" : "none";
            }
        });
    </script>
</body>
</html>