<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Streamers</title>
   
</head>
<body>
    <h1>Lista de Streamers</h1>
    
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="mensaje exito"><?= htmlspecialchars($_SESSION['mensaje']) ?></div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="mensaje error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if (empty($content)): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        No hay productos registrados
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($content as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['id']) ?></td>
                    <td><?= htmlspecialchars($p['username']) ?></td>
                    <td><img src="img/avatar.png"></td>
                    
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>