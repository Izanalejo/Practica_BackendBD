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
    }

        



?>