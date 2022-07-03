<?php 
    // comprobar si la existe una sesion iniciada
    if(!isset($_SESSION)){
        session_start();
    }

    // valdiar que si no esta logeado no debe ver ciertas paginas
    if(!$_SESSION['usuario']) {
        header('location:index.php');
    }
?>