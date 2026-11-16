<?php
session_start();
include 'conexion.php';

// Validar que el usuario haya iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: index.php");
    exit();
}

$nombre_paciente = $_SESSION['nombre_usuario'];

// Buscar las citas asociadas al paciente logueado
try {
    $stmt = $conexion->prepare("SELECT * FROM citas WHERE nombre_completo LIKE :nombre ORDER BY id DESC");
    $stmt->execute([':nombre' => "%$nombre_paciente%"]);
    $mis_citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $mis_citas = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Resultados - Laboratorios Buenfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <!-- Navbar idéntico al del index -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="index.php">
                <i class="fa-solid fa-flask-vial fa-lg me-2"></i> Laboratorios Buenfil web
            </a>
            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3 small"><i class="fa-solid fa-user-circle me-1"></i> Hola, <strong><?php echo htmlspecialchars($nombre_paciente); ?></strong></span>
                <a href="index.php" class="btn btn-outline-light rounded-pill px-4 btn-sm">Volver al Inicio</a>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container my-5">
        <div class="mb-4">
            <h2 class="fw-bold text-primary"><i class="fa-solid fa-file-medical me-2"></i>Mis Estudios y Resultados Clínicos</h2>
            <p class="text-muted">Consulta el estado de tus análisis y descarga tu reporte oficial en formato PDF cuando estén listos.</p>
        </div>

        <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
            <h4 class="text-primary mb-3"><i class="fa-solid fa-folder-open me-2"></i>Historial de Solicitudes</h4>
            
            <?php if (count($mis_citas) > 0): ?>
                <div class="table-responsive mt-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Folio</th>
                                <th>Estudio Clínico</th>
                                <th>Fecha Programada</th>
                                <th>Estado</th>
                                <th class="text-center">Acción / Reporte</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mis_citas as $cita): ?>
                            <tr>
                                <td><strong>#<?php echo $cita['id']; ?></strong></td>
                                <td><span class="badge bg-light text-primary border border-primary px-2 py-1"><?php echo htmlspecialchars($cita['estudio']); ?></span></td>
                                <td><?php echo $cita['fecha']; ?> (<?php echo $cita['hora'] ?? '--:--'; ?>)</td>
                                <td>
                                    <?php if (!empty($cita['resultados'])): ?>
                                        <span class="badge bg-success"><i class="fa-solid fa-check-circle me-1"></i> Resultados Listos</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> En Proceso</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($cita['resultados'])): ?>
                                        <a href="ver_resultado_pdf.php?id=<?php echo $cita['id']; ?>" target="_blank" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm fw-bold">
                                            <i class="fa-solid fa-file-pdf me-1"></i> Ver / Descargar PDF
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small fst-italic">El laboratorista está procesando tu muestra</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5 text-muted">
                    <i class="fa-regular fa-folder-open fa-3x mb-3 text-primary"></i>
                    <h5>No encontramos estudios a tu nombre</h5>
                    <p class="small">Asegúrate de haber agendado tu cita con el mismo nombre con el que iniciaste sesión.</p>
                    <a href="citas.php" class="btn btn-primary rounded-pill px-4 mt-2">Agendar una Cita</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="bg-white border-top py-4 mt-auto text-center text-muted">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 Laboratorios Buenfil web. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>