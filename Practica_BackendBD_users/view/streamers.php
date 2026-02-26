<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Streamers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f6f9;
            font-family: "Montserrat", sans-serif;
        }

        h1 {
            font-weight: 700;
            color: #2c3e50;
        }

        h2 {
            font-weight: 600;
            color: #34495e;
            border-left: 5px solid #3498db;
            padding-left: 10px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        table thead {
            background: #3498db;
            color: white;
        }

        table tbody tr:hover {
            background: rgba(52, 152, 219, 0.08);
        }

        table td,
        table th {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestión de Streamers</h1>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= htmlspecialchars($_SESSION['mensaje']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Lista de Streamers</h2>
            <a href="index.php?action=streamer&option=nuevoStreamer" class="btn btn-primary">+ Nuevo Streamer</a>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nombre Real</th>
                                <th>Followers</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($streamers)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">No hay Streamers registrados</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($streamers as $st): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($st['id']) ?></td>
                                        <td><strong><?= htmlspecialchars($st['username']) ?></strong></td>
                                        <td><?= htmlspecialchars($st['nombre_real']) ?></td>
                                        <td><?= htmlspecialchars($st['followers']) ?></td>
                                        <td>
                                            <a href="index.php?action=streamer&option=editarStreamer&id=<?= $st['id'] ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href="index.php?action=streamer&option=eliminarStreamer&id=<?= $st['id'] ?>" class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Seguro que quieres eliminar este streamer?')">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="index.php?action=streamer" class="btn btn-secondary">← Volver al Dashboard</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>