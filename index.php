<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/Database.php';
require_once 'controllers/UserController.php';

$db = Database::conectar();
$controller = new UserController($db);


    $action = $_GET['action'] ?? 'registro'; 
/* $username = $_POST['username'] ?? null; */

match ($action) {
    /* 'listar'   => $controller->mostrarLista(),
    'nuevo'    => $controller->mostrarFormulario(),
    'editar'   => $controller->mostrarFormulario($id),
    'guardar'  => $controller->procesar(),
    'eliminar' => $controller->borrar($id), */
    default    => $controller->registro(),
};
?>