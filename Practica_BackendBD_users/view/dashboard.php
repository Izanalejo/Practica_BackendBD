<?php

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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f6f9;
            font-family: "Montserrat", sans-serif;
        }

        h1 {
            font-weight: 700;
            font-size: 3rem;
            color: #2c3e50;
            letter-spacing: -1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        h2 {
            font-weight: 600;
            color: #34495e;
            border-left: 5px solid #3498db;
            padding-left: 10px;
            margin-bottom: 1.5rem;
        }

        /* Tarjetas */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        /* Tabla */
        table thead {
            background: #3498db;
            color: white;
        }

        table tbody tr {
            transition: background .2s ease;
        }

        table tbody tr:hover {
            background: rgba(52, 152, 219, 0.08);
        }

        table td,
        table th {
            vertical-align: middle;
        }

        /* Badges */
        .badge-id {
            background: #ecf0f1;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            color: #2c3e50;
            display: inline-block;
        }

        /* Botón personalizado */
        .btn-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            border: none;
            font-weight: 600;
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(243, 156, 18, 0.4);
        }

        /* Avatar redondeado */
        img {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Alertas */
        .alert {
            border-radius: 10px;
            font-weight: 600;
        }

        .card-destacado table thead {
            background: linear-gradient(135deg, #f6d365, #fda085) !important;
            color: #2c3e50 !important;
        }

        .card-destacado table thead th {
            background: transparent !important;
        }

        .card-destacado table tbody {
            background: rgba(246, 211, 101, 0.15) !important;
        }

        .card-destacado table tbody td {
            background: transparent !important;
        }

        .card-destacado table tbody tr:hover td {
            background: rgba(246, 211, 101, 0.35) !important;
        }
    </style>

</head>

<body>
    <div class="container">

        <h1 class="mt-5" style="text-align: center; font-family: 'Montserrat', sans-serif; font-weight: 700;">Bienvenido <?= $_SESSION['usuario'] ?></h1>
        <h2 style="margin-top: 5rem;">Destacado</h2>
        <div class="card card-destacado">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-image"></i> Avatar</th>
                                <th><i class="bi bi-person-circle"></i> Username</th>
                                <th><i class="bi bi-hash"></i> Nombre Real</th>
                                <th><i class="bi bi-hash"></i> Followers</th>
                                <th><i class="bi bi-hash"></i> Categoria</th>
                                <th></th>

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
                                            <img style="height: 100px;" src="<?= htmlspecialchars($d['avatar']) ?>" alt="Avatar de <?= htmlspecialchars($d['nombre_real']) ?>">
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
                                        <td>
                                            <span class="badge-id"><?= htmlspecialchars($d['categoria']) ?></span>
                                        </td>
                                        <td>
                                            <i class="bi bi-star-fill" style="font-size: 2.5rem; color: #f1c40f;"></i>
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
        <table style="display: flex; justify-self: center;">
            <tr>
                <td>
                    <div class="text-center mb-4">
                        <a href="index.php?action=categoria" class="btn btn-primary">Gestionar Categorías</a>
                    </div>
                </td>
                <td>
                    <div class="text-center mb-4">
                        <a href="index.php?action=streamer&option=listaStreamers" class="btn btn-primary">Gestionar Streamers</a>
                    </div>
                </td>
            </tr>
        </table>



        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> <?= htmlspecialchars($_SESSION['mensaje']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
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
                                <th><i class="bi bi-hash"></i> Categoria</th>

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
                                            <img style="height: 100px;" src="<?= htmlspecialchars($p['avatar']) ?>" alt="Avatar de <?= htmlspecialchars($p['nombre_real']) ?>">
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
                                            <span class="badge-id"><?= htmlspecialchars($p['categoria']) ?></span>
                                        </td>
                                        <td>
                                            <form action="" method="POST" style="display:inline;">
                                                <button class="btn btn-warning" type="submit" name="destacar" value="<?= $p['id'] ?>">
                                                    <i class="bi bi-star-fill"></i>
                                                </button>
                                            </form>
                                            <a href="index.php?action=streamer&option=editarCategoriasStreamer&id=<?= $p['id'] ?>" class="btn btn-info">
                                                <i class="bi bi-pencil-fill"></i>
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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>