<?php
require_once 'config/Database.php';
require_once 'controller/UserController.php';
require_once 'controller/StreamerController.php';
require_once 'controller/CategoriaController.php'; // <- añadir esto

class MainController
{
    public function __construct() {}

    public function processRequest()
    {
        $db = Database::conectar();
        $action = $_GET['action'] ?? 'registro';

       switch ($action) {
    case "streamer":
        $controllerStreamer = new StreamerController($db);
        $controllerStreamer->processRequest();
        break;
    case "categoria":
        $controllerCat = new CategoriaController($db);
        $controllerCat->processRequest();
        break;
    default:
        $controllerUser = new UserController($db);
        $controllerUser->processRequest();
        break;
}
    }
}
