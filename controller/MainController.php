<?php 
require_once 'config/Database.php';
require_once 'controller/UserController.php';
require_once 'controller/StreamerController.php';
class MainController{
    
    public function __construct() {}


    public function processRequest(){
        $db = Database::conectar();
        $controllerUser = new UserController($db);
        $controllerStreamer = new StreamerController($db);

        $action = $_GET['action'] ?? 'registro';
        $username = $_POST['username'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destacar'])) {
            $controllerStreamer->btnDestacar($_POST['destacar']);
            header("Location: index.php?action=dashboard");
            exit;
        };

        match ($action) {
            'registro' => $controllerUser->registro(),
            'dashboard'   => $controllerStreamer->dashboard(),
            /*'guardar'  => $controller->procesar(),
            'eliminar' => $controller->borrar($id), */
            default => $controllerUser->registroform(),
        };
    }
}




























?>