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
            case 'user':
                $controllerUser = new UserController($db);
                $controllerUser->processRequest();
                break;

            case 'streamer':
            case 'listaStreamers':
            case 'nuevoStreamer':
            case 'crearStreamer':
            case 'editarStreamer':
            case 'actualizarStreamer':
            case 'eliminarStreamer':
            case 'editarCategoriasStreamer':
            case 'guardarCategoriasStreamer':
                $controllerStreamer = new StreamerController($db);
                $controllerStreamer->processRequest();
                break;

            case 'categoria':
            case 'listaCategorias':
            case 'nuevaCategoria':
            case 'crearCategoria':
            case 'editarCategoria':
            case 'actualizarCategoria':
            case 'eliminarCategoria':
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
