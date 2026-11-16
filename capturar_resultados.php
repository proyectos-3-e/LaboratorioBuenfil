<?php
session_start();
include 'conexion.php';

// Validar que venga el ID de la cita
if (!isset($_GET['id'])) {
    header("Location: panel_laboratorista.php");
    exit();
}

$id_cita = $_GET['id'];

// Guardar resultados si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resultados = $_POST['resultados'];
    
    $update = $conexion->prepare("UPDATE citas SET resultados = :resultados, estado = 'Atendida' WHERE id = :id");
    $update->execute([':resultados' => $resultados, ':id' => $id_cita]);
    
    header("Location: panel_laboratorista.php?exito=1");
    exit();
}

// Obtener datos de la cita del paciente
$stmt = $conexion->prepare("SELECT * FROM citas WHERE id = :id");
$stmt->execute([':id' => $id_cita]);
$cita = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cita) {
    die("Cita no encontrada.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Captura de Resultados - Laboratorios Buenfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Editor de texto estilo Word (TinyMCE) -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#editor-resultados',
            height: 380,
            menubar: false,
            plugins: 'lists table code',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist table | removeformat',
            language: 'es'
        });
    </script>
</head>
<body class="bg-light">

    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 shadow-sm py-3">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="panel_laboratorista.php">
                <i class="fa-solid fa-flask-vial bg-white text-primary p-2 rounded me-2"></i> Laboratorios Buenfil web
            </a>
            <div class="d-flex align-items-center ms-auto">
                <a href="panel_laboratorista.php" class="btn btn-outline-light rounded-pill px-4"><i class="fa-solid fa-arrow-left me-1"></i> Volver al Panel</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Formulario con diseño de hoja de reporte -->
                <form method="POST" class="card shadow-lg border-0 rounded-4 p-5 bg-white">
                    
                    <!-- Membrete institucional -->
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
                        <div>
                            <h3 class="text-primary fw-bold mb-1"><i class="fa-solid fa-flask me-2"></i>Laboratorios Buenfil</h3>
                            <p class="text-muted small mb-0">Reporte Oficial de Resultados Clínicos</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary fs-6 px-3 py-2">Folio: #<?php echo $cita['id']; ?></span>
                            <p class="text-muted small mt-1 mb-0">Fecha: <?php echo date('Y-m-d'); ?></p>
                        </div>
                    </div>

                    <!-- Datos generales del paciente (Fijos e incambiables) -->
                    <div class="bg-light p-4 rounded-3 mb-4 border">
                        <h6 class="text-secondary fw-bold mb-3"><i class="fa-solid fa-user-injured me-2"></i>Información del Paciente</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Paciente:</strong> <?php echo htmlspecialchars($cita['nombre_completo']); ?></p>
                                <p class="mb-1"><strong>Teléfono:</strong> <?php echo htmlspecialchars($cita['telefono'] ?? 'N/D'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Estudio Solicitado:</strong> <span class="text-primary fw-bold"><?php echo htmlspecialchars($cita['estudio']); ?></span></p>
                                <p class="mb-1"><strong>Fecha Programada:</strong> <?php echo $cita['fecha']; ?> (<?php echo $cita['hora'] ?? '--:--'; ?>)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Área del Editor tipo Word -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark fs-6 mb-2"><i class="fa-solid fa-file-lines me-2"></i>Plantilla de Resultados y Diagnóstico</label>
                        <p class="text-muted small mb-2">Redacte o pegue los resultados estructurados del análisis. Este formato se reflejará directamente en el ticket del cliente.</p>
                        
                        <textarea id="editor-resultados" name="resultados"><?php echo htmlspecialchars($cita['resultados'] ?? '<p><strong>Valores Obtenidos:</strong></p><ul><li>Parámetro analítico 1: </li><li>Parámetro analítico 2: </li></ul><p><strong>Observaciones del Especialista:</strong> </p>'); ?></textarea>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-end gap-3 border-top pt-4">
                        <a href="panel_laboratorista.php" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar y Enviar al Cliente
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>