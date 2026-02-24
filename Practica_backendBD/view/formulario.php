<?php
require_once 'config/Database.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="form-container">
                    <?php
                    try {
                        $db = Database::conectar();
                        echo '<div class="alert alert-success text-center mb-4 mt-5">Conectado a Base de Datos con éxito!</div>';
                    } catch (exception $e) {
                        echo '<div class="alert alert-danger text-center mb-4">Error en conexión con Base de Datos.</div>';
                    }
                    ?>
                    
                    <div class="card mt-5">
                        <div class="card-body">
                            <h1 class="card-title text-center">Formulario de Registro</h1>
                            
                            <form method="post" action="index.php?action=registro">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Ingresa tu nombre de usuario" >
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>