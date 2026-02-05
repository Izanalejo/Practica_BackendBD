<?php

require_once 'config/Database.php';
require_once 'controller/UserController.php';


$db = Database::conectar();

$controller = new UserController($db);

$action = $_GET['action'] ?? 'registro';
$username = $_POST['username'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destacar'])) {
    $controller->btnDestacar($_POST['destacar']);
    header("Location: index.php?action=dashboard");
    exit;
};

match ($action) {
    'registro' => $controller->registro(),
    'dashboard'   => $controller->dashboard(),
    /*'guardar'  => $controller->procesar(),
    'eliminar' => $controller->borrar($id), */
    default => $controller->registroform(),
};


?>

