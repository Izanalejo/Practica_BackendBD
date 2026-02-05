<?php
require_once 'model/User.php';
require_once 'model/Streamers.php';
require_once 'UserView.php';
require_once 'config/Database.php';
class UserController
{
    private User $modelo;
    private UserView $view;



    public function __construct(PDO $db)
    {
        $this->modelo = new User($db);
        $this->view = new UserView();
    }
    public function processRequest(){
        $action = $_GET['action'] ?? 'registro';

        switch ($action) {
            case 'registro':
                $this->registro();
                break;
            default:
                $this->registroform();
                break;
        }
    }

  public function registroform(){
    $this->view->display('view/formulario.php');

  }

      public function registro(){
        //Iniciar sesión si no está iniciada
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        // Verificar que sea una petición POST y que exista el username
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && !empty($_POST['username'])) {
            $username = trim($_POST['username']);

            $_SESSION['usuario'] = $username;
            $buscaUser = $this->modelo->obtenerPorUsername($username);
            
            // Verificar si el usuario ya existe
            if ( $buscaUser != null) {
                // Usuario existe, redirigir al dashboard
                $this->modelo->actualizar($username, date('Y-m-d H:i:s'));
                header('Location: index.php?action=streamer');
                exit;
            } else {
                // Usuario no existe, añadirlo
                $this->modelo->añadir($username, date('Y-m-d H:i:s'), 1);
                
                // Redirigir al dashboard después de registrar
                header('Location: index.php?action=streamer');
                exit;
                
            }
            
        } else {
            // Si no hay datos POST, mostrar el formulario
            $this->registroform();
        }
    }

    
}


