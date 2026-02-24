<?php

    class StreamerController{
    private UserView $view;
    private Streamer $modelost;
    public function __construct(PDO $db)
    {
        $this->modelost = new Streamer($db);
        $this->view = new UserView();
    }

    public function processRequest(){
        $action = $_GET['action'] ?? 'dashboard';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destacar'])) {
            $this->btnDestacar($_POST['destacar']);
            header("Location: index.php?action=streamer");
            exit;
        }
        
        switch ($action) {
            case 'dashboard':
                $this->dashboard();
                break;
            case 'editarCategoriasStreamer':
            $this->editarCategoriasStreamer();
            break;
            case 'guardarCategoriasStreamer':
            $this->guardarCategoriasStreamer();
            break;
            default:
                $this->dashboard();
                break;
        }
    }

    public function dashboard(){
        $streamers = $this->modelost->listar();
        $destacado = $this->modelost->destacado();
        $this->view->display('view/dashboard.php', ['content' => $streamers, 'destacado' => $destacado]);
        }
    public function btnDestacar($id){
        $this->modelost->destacar($id);
    }


    public function editarCategoriasStreamer()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

    if (!$id) {
        header("Location: index.php?action=streamer");
        exit;
    }

    $streamer = $this->modelost->obtenerPorId($id);
    $categorias = $this->modelost->listarCategorias();
    $categoriasActuales = $this->modelost->obtenerCategorias($id);

    $this->view->display('view/formulario_categorias_streamer.php', [
        'streamer' => $streamer,
        'categorias' => $categorias,
        'categoriasActuales' => $categoriasActuales
    ]);
}

public function guardarCategoriasStreamer()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['streamer_id'])) {
        $streamerId = (int)$_POST['streamer_id'];
        $categorias = $_POST['categorias'] ?? [];

        $this->modelost->asignarCategorias($streamerId, $categorias);
        $_SESSION['mensaje'] = "Categorías actualizadas correctamente.";
        header("Location: index.php?action=streamer");
        exit;
    }

    header("Location: index.php?action=streamer");
    exit;
}
    }

        



?>