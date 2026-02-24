<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($categoria) ? 'Editar' : 'Nueva' ?> Categoría</title>
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
                        <?= isset($categoria) ? 'Editar Categoría' : 'Nueva Categoría' ?>
                    </h1>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['error']) ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <form method="POST" action="index.php?action=<?= isset($categoria) ? 'actualizarCategoria' : 'crearCategoria' ?>">
                        
                        <?php if (isset($categoria)): ?>
                            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?= isset($categoria) ? htmlspecialchars($categoria['nombre']) : '' ?>"
                                laceholder="Ej: Gaming, Música, Arte...">
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                placeholder="Describe brevemente esta categoría..."><?= isset($categoria) ? htmlspecialchars($categoria['descripcion']) : '' ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <?= isset($categoria) ? 'Guardar cambios' : 'Crear categoría' ?>
                            </button>
                            <a href="index.php?action=listaCategorias" class="btn btn-secondary">Cancelar</a>
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