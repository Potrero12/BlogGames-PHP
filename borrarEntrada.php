<?php

    require_once './includes/conexion.php';

    if(isset($_SESSION['usuario']) && $_GET['id']){

        $entradaId = (int)$_GET['id'];
        $usuarioId = (int)$_SESSION['usuario']['id'];
        $sql = "DELETE FROM entradas WHERE usuario_id = $usuarioId AND id = $entradaId";
        $entrada_eliminada = mysqli_query($db, $sql);

    }

    header('location:index.php');
?>