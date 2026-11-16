<?php
session_start();
include("conexion.php");

$id_cita = $_GET['id'] ?? null;
if (!$id_cita) {
    echo "ID de cita no válido.";
    exit();
}

try {
    $stmt = $conexion->prepare("SELECT * FROM citas WHERE id = :id");
    $stmt->bindParam(':id', $id_cita, PDO::PARAM_INT);
    $stmt->execute();
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cita) {
        echo "Cita no encontrada.";
        exit();
    }
} catch (PDOException $e) {
    die("Error en la base de datos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Resultados #<?php echo $cita['id']; ?> - Laboratorios Buenfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .ticket-card { max-width: 800px; margin: 40px auto; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .lab-header { border-bottom: 2px solid #0d6efd; padding-bottom: 20px; margin-bottom: 20px; }
        @media print {
            body { background: #fff; }
            .no-print { display: none !important; }
            .ticket-card { box-shadow: none; margin: 0; padding: 15px; width: 100%; max-width: 100%; }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="ticket-card">
            <!-- Encabezado Institucional -->
            <div class="lab-header d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold text-primary m-0"><i class="fa-solid fa-flask-vial me-2"></i>Laboratorios Buenfil</h3>
                    <p class="text-muted small m-0">Reporte Oficial de Resultados Clínicos</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-primary fs-6 px-3 py-2">Folio #<?php echo $cita['id']; ?></span>
                    <p class="text-muted small m-0 mt-1">Estado: <strong class="text-success"><?php echo htmlspecialchars($cita['estado']); ?></strong></p>
                </div>
            </div>

            <!-- Datos del Paciente -->
            <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-user-injured me-2 text-primary"></i>Información del Paciente</h5>
            <div class="row bg-light p-3 rounded-3 mb-4 g-2">
                <div class="col-md-6"><strong>Nombre:</strong> <?php echo htmlspecialchars($cita['nombre_completo']); ?></div>
                <div class="col-md-6"><strong>Teléfono:</strong> <?php echo htmlspecialchars($cita['telefono'] ?? 'N/D'); ?></div>
                <div class="col-md-6"><strong>Correo:</strong> <?php echo htmlspecialchars($cita['correo'] ?? 'N/D'); ?></div>
                <div class="col-md-6"><strong>Fecha de Toma:</strong> <?php echo htmlspecialchars($cita['fecha']); ?> (<?php echo htmlspecialchars($cita['hora'] ?? '--:--'); ?>)</div>
            </div>

            <!-- Estudio Solicitado -->
            <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-microscope me-2 text-primary"></i>Estudio Solicitado</h5>
            <div class="p-3 border rounded-3 mb-4 bg-white">
                <span class="badge bg-primary-subtle text-primary border border-primary px-3 py-2 fs-6 fw-bold">
                    <?php echo htmlspecialchars($cita['estudio']); ?>
                </span>
            </div>

            <!-- Resultados en HTML enriquecido (TinyMCE) -->
            <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-file-waveform me-2 text-success"></i>Diagnóstico y Valores Clínicos</h5>
            <div class="p-4 border rounded-3 mb-4 bg-light" style="min-height: 180px;">
                <?php if (!empty($cita['resultados'])): ?>
                    <!-- Se imprime con html_entity_decode o directo porque TinyMCE guarda etiquetas HTML -->
                    <div class="text-dark">
                        <?php echo $cita['resultados']; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4 text-muted">
                        <i class="fa-solid fa-clock fa-2x mb-2 text-warning"></i>
                        <p class="mb-0 fst-italic">Los resultados de este estudio se encuentran en proceso de análisis por el laboratorista.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Botones de Acción (No salen al imprimir) -->
            <div class="no-print d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fa-solid fa-arrow-left me-1"></i> Regresar
                </a>
                <button onclick="window.print()" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Imprimir / Guardar como PDF
                </button>
            </div>
        </div>
    </div>

</body>
</html>