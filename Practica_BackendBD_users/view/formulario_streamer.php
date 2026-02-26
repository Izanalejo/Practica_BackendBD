<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($streamer) ? 'Editar' : 'Nuevo' ?> Streamer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: "Montserrat", sans-serif; }
        .card { border: none; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">
                        <?= isset($streamer) ? 'Editar Streamer' : 'Nuevo Streamer' ?>
                    </h1>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['error']) ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <form method="POST" action="index.php?action=<?= isset($streamer) ? 'actualizarStreamer' : 'crearStreamer' ?>">
                        
                        <?php if (isset($streamer)): ?>
                            <input type="hidden" name="id" value="<?= $streamer['id'] ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?= isset($streamer) ? htmlspecialchars($streamer['username']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nombre_real" class="form-label">Nombre_real:</label>
                            <input type="text" class="form-control" id="nombre_real" name="nombre_real" rows="3"
                                value="<?= isset($streamer) ? htmlspecialchars($streamer['nombre_real']) : '' ?>"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Followers:</label>
                            <input type="number" class="form-control" id="followers" name="followers"
                                value="<?= isset($streamer) ? htmlspecialchars($streamer['followers']) : '' ?>">
                        </div>
                        

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <?= isset($streamer) ? 'Guardar cambios' : 'Crear streamer' ?>
                            </button>
                            <a href="index.php?action=listaStreamers" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>