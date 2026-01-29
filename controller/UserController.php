<?php

require_once 'model/User.php';
require_once 'UserView.php';
class UserController
{
private User $modelo;
    private UserView $view;



    public function __construct(PDO $db)
    {
        $this->modelo = new User($db);
        $this->view = new UserView();
    }

  public function registro(){
    $this->view->display('view/formulario.php');
    
  }
}
