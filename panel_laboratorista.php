<?php
session_start();
include 'conexion.php';

// Consultar todas las citas ordenadas de la más reciente a la más antigua
$stmt = $conexion->prepare("SELECT * FROM citas ORDER BY id DESC");
$stmt->execute();
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Laboratorios Buenfil web - Panel Laboratorista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <!-- Navbar superior con el estilo institucional -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 shadow-sm py-3">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
                <i class="fa-solid fa-flask-vial bg-white text-primary p-2 rounded me-2"></i> Laboratorios Buenfil web
            </a>
            <div class="d-flex align-items-center ms-auto">
                <span class="text-white me-3"><i class="fa-solid fa-user-tie me-1"></i> Hola, <strong>Laboratorista</strong></span>
                <a href="logout.php" class="btn btn-outline-light rounded-pill px-4">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Encabezado de sección -->
        <div class="mb-4">
            <h2><i class="fa-solid fa-microscope text-primary me-2"></i> Gestión de Resultados de Laboratorio</h2>
            <p class="text-muted">Recepción de muestras, captura de diagnósticos y actualización de tickets.</p>
        </div>

        <?php if (isset($_GET['exito'])): ?>
            <div class="alert alert-success shadow-sm">¡Resultados guardados y enviados al cliente con éxito!</div>
        <?php endif; ?>

        <!-- Tarjeta contenedora -->
        <div class="card shadow-sm border-0 p-4 rounded-4 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-primary m-0"><i class="fa-solid fa-calendar-days me-2"></i>Citas y Solicitudes de Análisis</h4>
            </div>
            <p class="text-muted small">Listado general de solicitudes registradas en el sistema.</p>

            <div class="table-responsive mt-2">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>ID</th>
                            <th>Estudio / Análisis</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Paciente</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($citas as $row): ?>
                        <tr>
                            <td><strong>#<?php echo $row['id']; ?></strong></td>
                            <td><span class="badge bg-light text-primary border border-primary px-2 py-1"><?php echo htmlspecialchars($row['estudio']); ?></span></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td><?php echo $row['hora'] ?? '--:--'; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['nombre_completo']); ?></strong></td>
                            <td><?php echo htmlspecialchars($row['telefono'] ?? 'N/D'); ?></td>
                            <td><?php echo htmlspecialchars($row['correo'] ?? 'N/D'); ?></td>
                            <td>
                                <?php 
                                    $estado = $row['estado'] ?? 'En espera';
                                    $badgeColor = 'warning text-dark';
                                    if ($estado == 'Atendida' || $estado == 'Completado') $badgeColor = 'success';
                                    if ($estado == 'Cancelada') $badgeColor = 'danger';
                                ?>
                                <span class="badge bg-<?php echo $badgeColor; ?>"><?php echo $estado; ?></span>
                            </td>
                            <td class="text-center">
                                <!-- Enlace directo a la hoja tipo Word que creamos -->
                                <a href="capturar_resultados.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Capturar Resultados
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>