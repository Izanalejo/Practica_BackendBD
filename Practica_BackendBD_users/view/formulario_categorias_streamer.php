<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: "Montserrat", sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">
                            Editar categorías de <strong><?= htmlspecialchars($streamer['username']) ?></strong>
                        </h1>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($_SESSION['error']) ?>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <form method="POST" action="index.php?action=streamer&option=guardarCategoriasStreamer">
                            <input type="hidden" name="streamer_id" value="<?= $streamer['id'] ?>">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Categorías:</label>
                                <?php foreach ($categorias as $cat): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="categorias[]"
                                            value="<?= $cat['id'] ?>"
                                            id="cat_<?= $cat['id'] ?>"
                                            <?= in_array($cat['id'], $categoriasActuales) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="cat_<?= $cat['id'] ?>">
                                            <?= htmlspecialchars($cat['nombre']) ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                <a href="index.php?action=streamer" class="btn btn-secondary">Cancelar</a>
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