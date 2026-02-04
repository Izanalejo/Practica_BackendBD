<?php
require_once 'model/User.php';
require_once 'model/Streamers.php';
require_once 'UserView.php';
require_once 'config/Database.php';
class UserController
{
private User $modelo;
    private UserView $view;
    private Streamer $modelost;



    public function __construct(PDO $db)
    {
        $this->modelo = new User($db);
        $this->modelost = new Streamer($db);
        $this->view = new UserView();
    }

  public function registroform(){
    $this->view->display('view/formulario.php');

  }

      public function registro(){
        // Verificar que sea una petición POST y que exista el username
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && !empty($_POST['username'])) {
            $username = trim($_POST['username']);
            $buscaUser = $this->modelo->obtenerPorUsername($username);
            $_SESSION['usuario'] = $username;
            // Verificar si el usuario ya existe
            if ( $buscaUser != null) {
                // Usuario existe, redirigir al dashboard
                $this->modelo->actualizar($username, date('Y-m-d H:i:s'));
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                // Usuario no existe, añadirlo
                $this->modelo->añadir($username, date('Y-m-d H:i:s'), 1);
                
                // Redirigir al dashboard después de registrar
                header('Location: index.php?action=dashboard');
                exit;
                
            }
            
        } else {
            // Si no hay datos POST, mostrar el formulario
            $this->registroform();
        }
    }

    public function dashboard(){
        $streamers = $this->modelost->listar();
        $destacado = $this->modelost->destacado();
        $this->view->display('view/dashboard.php', ['content' => $streamers, 'destacado' => $destacado]);
    }
}
