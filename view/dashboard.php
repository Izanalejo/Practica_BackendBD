<?php 
session_start();
require_once 'controller/UserController.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Streamers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
</head>
<body>
    <div class="container">

        <h1>Bienvenido <?= $_SESSION['usuario'] ?></h1>
        <h2 style="margin-top: 5rem;">Destacado</h2>
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-image"></i> Avatar</th>
                                <th><i class="bi bi-person-circle"></i> Username</th>
                                <th><i class="bi bi-hash"></i> Nombre Real</th>
                                <th><i class="bi bi-hash"></i> Followers</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($content)): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="mt-3 mb-0">No hay streamers registrados</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($destacado as $d): ?>
                                <tr>
                                    <td>
                                        <img style="height: 100px;" src="<?=htmlspecialchars($d['avatar']) ?>" alt="Avatar de <?= htmlspecialchars($d['nombre_real']) ?>">
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($d['username']) ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge-id"><?= htmlspecialchars($d['nombre_real']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge-id"><?= htmlspecialchars($d['followers']) ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h2 style="margin-top: 5rem;">Lista de Streamers</h2>
        
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> <?= htmlspecialchars($_SESSION['mensaje']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-image"></i> Avatar</th>
                                <th><i class="bi bi-person-circle"></i> Username</th>
                                <th><i class="bi bi-hash"></i> Nombre Real</th>
                                <th><i class="bi bi-hash"></i> Followers</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($content)): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="mt-3 mb-0">No hay streamers registrados</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($content as $p): ?>
                                <tr>
                                    <td>
                                        <img style="height: 100px;" src="<?=htmlspecialchars($p['avatar']) ?>" alt="Avatar de <?= htmlspecialchars($p['nombre_real']) ?>">
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($p['username']) ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge-id"><?= htmlspecialchars($p['nombre_real']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge-id"><?= htmlspecialchars($p['followers']) ?></span>
                                    </td>
                                    <td>
                                        <form action="" method="POST">
                                        <button class="btn btn-warning" type="submit" name="destacar" value="<?= $p['id'] ?>">Cambiar destacado</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
