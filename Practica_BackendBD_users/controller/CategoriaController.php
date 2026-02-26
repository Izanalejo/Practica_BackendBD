<?php
require_once 'model/Categoria.php';
require_once 'UserView.php';

class CategoriaController
{
    private Categoria $modelocat;
    private UserView $view;

    
    public function __construct(PDO $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
        $this->modelocat = new Categoria($db);
        $this->view = new UserView();
    }

  public function processRequest()
{
    $option = $_GET['option'] ?? 'listaCategorias';

    switch ($option) {
        case 'listaCategorias':    $this->listaCategorias();   break;
        case 'nuevaCategoria':     $this->nuevaCategoria();    break;
        case 'crearCategoria':     $this->crearCategoria();    break;
        case 'editarCategoria':    $this->editarCategoria();   break;
        case 'actualizarCategoria': $this->actualizarCategoria(); break;
        case 'eliminarCategoria':  $this->eliminarCategoria(); break;
        default:                   $this->listaCategorias();   break;
    }
}

    public function listaCategorias()
    {
        $categorias = $this->modelocat->listar();
        $this->view->display('view/categorias.php', ['categorias' => $categorias]);
    }

    public function nuevaCategoria()
    {
        $this->view->display('view/formulario_categoria.php');
    }

    public function crearCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
            $nombre = htmlspecialchars(trim($_POST['nombre']));
            $descripcion = htmlspecialchars(trim($_POST['descripcion'] ?? ''));

            if (empty($nombre)) {
                $_SESSION['error'] = "El nombre no puede estar vacío.";
                header("Location: index.php?action=nuevaCategoria");
                exit;
            }

            if ($this->modelocat->existeNombre($nombre)) {
                $_SESSION['error'] = "Ya existe una categoría con ese nombre.";
                header("Location: index.php?action=nuevaCategoria");
                exit;
            }

            $this->modelocat->añadir($nombre, $descripcion);
            $_SESSION['mensaje'] = "Categoría creada correctamente.";
            header("Location: index.php?action=categoria&option=listaCategorias");
            exit;
        }

        $this->nuevaCategoria();
    }

    public function editarCategoria()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if (!$id) {
            header("Location: index.php?action=categoria&option=listaCategorias");
            exit;
        }

        $categoria = $this->modelocat->obtenerPorId($id);

        if (!$categoria) {
            $_SESSION['error'] = "Categoría no encontrada.";
            header("Location: index.php?action=categoria&option=listaCategorias");
            exit;
        }

        $this->view->display('view/formulario_categoria.php', ['categoria' => $categoria]);
    }

    public function actualizarCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $nombre = htmlspecialchars(trim($_POST['nombre']));
            $descripcion = htmlspecialchars(trim($_POST['descripcion'] ?? ''));

            if (empty($nombre)) {
                $_SESSION['error'] = "El nombre no puede estar vacío.";
                header("Location: index.php?action=categoria&option=editarCategoria&id=$id");
                exit;
            }

            if ($this->modelocat->existeNombre($nombre, $id)) {
                $_SESSION['error'] = "Ya existe otra categoría con ese nombre.";
                header("Location: index.php?action=categoria&option=editarCategoria&id=$id");
                exit;
            }

            $this->modelocat->actualizar($id, $nombre, $descripcion);
            $_SESSION['mensaje'] = "Categoría actualizada correctamente.";
            header("Location: index.php?action=categoria&option=listaCategorias");
            exit;
        }

        header("Location: index.php?action=categoria&option=listaCategorias");
        exit;
    }

    public function eliminarCategoria()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if (!$id) {
            header("Location: index.php?action=categoria&option=listaCategorias");
            exit;
        }

        if ($this->modelocat->tieneStreamers($id)) {
            $_SESSION['error'] = "No se puede eliminar una categoría que tiene streamers asignados.";
            header("Location: index.php?action=categoria&option=listaCategorias");
            exit;
        }

        $this->modelocat->eliminar($id);
        $_SESSION['mensaje'] = "Categoría eliminada correctamente.";
        header("Location: index.php?action=categoria&option=listaCategorias");

        exit;
    }
}