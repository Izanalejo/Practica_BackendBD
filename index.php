<?php

require_once 'config/Database.php';
require_once 'controller/UserController.php';


$db = Database::conectar();

$controller = new UserController($db);

$action = $_GET['action'] ?? 'registro';
$username = $_POST['username'] ?? null;

match ($action) {
    'registro' => $controller->registro(),
    'dashboard'   => $controller->dashboard(),
    /*'guardar'  => $controller->procesar(),
    'eliminar' => $controller->borrar($id), */
    default => $controller->registroform(),
};

?>

