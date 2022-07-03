<?php require_once './includes/helper.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Blog - Videojuegos</title>
</head>
<body>
    <header id="cabecera">
        <!-- logo -->
        <div id="logo">
            <a href="index.php">
                Blog De Videojuegos
            </a>
        </div>

        <!-- menu -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <?php $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)): 
                    ?>
                        <li>
                            <a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
                        </li>               
                    <?php
                        endwhile;
                    endif; 
                ?>
                <li>
                    <a href="index.php">Sobre mi</a>
                </li>
                <li>
                    <a href="index.php">Contacto</a>
                </li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>
    <div id="contenedor">