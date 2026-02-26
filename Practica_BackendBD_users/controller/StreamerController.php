<?php

class StreamerController
{
    private UserView $view;
    private Streamer $modelost;
    public function __construct(PDO $db)
    {
        $this->modelost = new Streamer($db);
        $this->view = new UserView();
    }

    public function processRequest()
{
    $option = $_GET['option'] ?? 'dashboard';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destacar'])) {
            $this->btnDestacar($_POST['destacar']);
            header("Location: index.php?action=streamer");
            exit;
        }

    switch ($option) {
        case 'listaStreamers':             $this->listaStreamers();            break;
        case 'nuevoStreamer':               $this->nuevoStreamer();              break;
        case 'crearStreamer':               $this->crearStreamer();              break;
        case 'editarStreamer':              $this->editarStreamer();             break;
        case 'actualizarStreamer':          $this->actualizarStreamer();         break;
        case 'eliminarStreamer':            $this->eliminarStreamer();           break;
        case 'editarCategoriasStreamer':    $this->editarCategoriasStreamer();   break;
        case 'guardarCategoriasStreamer':   $this->guardarCategoriasStreamer();  break;
        default:                           $this->dashboard();                  break;
    }
}
    public function dashboard()
    {
        $streamers = $this->modelost->listar();
        $destacado = $this->modelost->destacado();
        $this->view->display('view/dashboard.php', ['content' => $streamers, 'destacado' => $destacado]);
    }
    public function btnDestacar($id)
    {
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


    public function listaStreamers(){
        $streamers = $this->modelost->listar();
        $this->view->display('view/streamers.php', ['streamers' => $streamers]);
    }
    public function nuevoStreamer() {
        $this->view->display('view/formulario_streamer.php');
    }
    public function crearStreamer(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
            $username = htmlspecialchars(trim($_POST['username']));
            $nombre_real = htmlspecialchars(trim($_POST['descripcion'] ?? ''));
            $followers = htmlspecialchars(trim($_POST['followers']));
            $destacado = htmlspecialchars(trim($_POST['destacado']));

            if (empty($username)) {
                $_SESSION['error'] = "El username no puede estar vacío.";
                header("Location: index.php?action=streamer&option=nuevoStreamer");
                exit;
            }

            if ($this->modelost->existeNombre($username)) {
                $_SESSION['error'] = "Ya existe un streamer con ese username.";
                header("Location: index.php?action=streamer&option=nuevoStreamer");
                exit;
            }

            $this->modelost->añadir($username, $nombre_real, $followers, $destacado);
            $_SESSION['mensaje'] = "Streamer creado correctamente.";
            header("Location: index.php?action=streamer&option=listaStreamers");
            exit;
        }

        $this->nuevoStreamer();
    }
    public function editarStreamer(){
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if (!$id) {
            header("Location: index.php?action=listaStreamers");
            exit;
        }

        $streamer = $this->modelost->obtenerPorId($id);

        if (!$streamer) {
            $_SESSION['error'] = "Streamer no encontrado.";
            header("Location: index.php?action=listaStreamers");
            exit;
        }

        $this->view->display('view/formulario_Streamer.php', ['streamer' => $streamer]);
    }
    public function actualizarStreamer(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $username = htmlspecialchars(trim($_POST['username']));
            $nombre_real = htmlspecialchars(trim($_POST['descripcion'] ?? ''));
            $followers = htmlspecialchars(trim($_POST['followers']));
            $destacado = htmlspecialchars(trim($_POST['destacado']));

            if (empty($username)) {
                $_SESSION['error'] = "El username no puede estar vacío.";
                header("Location: index.php?action=editarStreamer&id=$id");
                exit;
            }

            if ($this->modelost->existeNombre($username, $id)) {
                $_SESSION['error'] = "Ya existe otro streamer con ese username.";
                header("Location: index.php?action=editarStreamer&id=$id");
                exit;
            }

            $this->modelost->actualizar($id, $username, $nombre_real, $followers, $destacado);
            $_SESSION['mensaje'] = "Streamer actualizado correctamente.";
            header("Location: index.php?action=streamer&option=listaStreamers");
            exit;
        }

        header("Location: index.php?action=streamer&option=listaStreamers");
        exit;
    }
    public function eliminarStreamer(){
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if (!$id) {
            header("Location: index.php?action=streamer&option=listaStreamers");
            exit;
        }

        $this->modelost->eliminar($id);
        $_SESSION['mensaje'] = "Streamer eliminado correctamente.";
        header("Location: index.php?action=streamer&option=listaStreamers");

        exit;
    }
}
