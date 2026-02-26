<?php

require_once "controller/MainController.php";
session_start();


    $controller = new MainController();

    $controller->processRequest();
?>

