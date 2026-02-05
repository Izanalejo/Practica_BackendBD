<?php
require_once 'config/Database.php';
require_once 'controller/UserController.php';
require_once 'controller/StreamerController.php';
class MainController
{

    public function __construct()
    {
    }


    public function processRequest()
    {
        $db = Database::conectar();
        /* 
         $controllerStreamer = new StreamerController($db); */

        $action = $_GET['action'] ?? 'registro';

        switch ($action) {

            case 'user':
                $controllerUser = new UserController($db);
                $controllerUser->processRequest();
                break;
            case 'streamer':
                $controllerStreamer = new StreamerController($db);
                $controllerStreamer->processRequest();
                break;

            default: //Registrar Usuario
                $controllerUser = new UserController($db);
                $controllerUser->processRequest();
                break;
        }

    }
}




























?>