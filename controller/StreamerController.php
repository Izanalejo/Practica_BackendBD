<?php

    class StreamerController{
    private UserView $view;
    private Streamer $modelost;
    public function __construct(PDO $db)
    {
        $this->modelost = new Streamer($db);
        $this->view = new UserView();
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