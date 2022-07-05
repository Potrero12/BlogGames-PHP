<?php 
    if(!isset($_POST['buscar'])){
        header('location:index.php');
    }
?>

<!-- Cabecera - menu  -->
<?php require_once './includes/cabecera.php'?>
<!-- contenido lateral  -->
<?php require_once './includes/sidebar.php'?>


<!-- Contenido -->
<div id="principal">
    <h1>Busqueda: <?=$_POST['buscar']?></h1>

    <!-- usar el while para recorrer los arrays de las consultas -->
    <?php $busquedas = conseguirEntradas($db, null, null, $_POST['buscar']);

        if(!empty($busquedas)):
            while($busqueda = mysqli_fetch_assoc($busquedas)):
        ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$busqueda['id']?>">
                    <h2><?=$busqueda['titulo']?></h2>
                    <span class="fecha"><?=$busqueda['categoria'].' | '.$busqueda['fecha']?></span>
                    <p><?=substr($busqueda['descripcion'], 0, 300)."..."?></p>
                </a>               
            </article>
        <?php
            endwhile; 
            else:
            ?>
            <div class="alerta">No hay resultados para esta busqueda</div>    
        <?php 
            endif;
        ?>
        
        
</div>

<!-- footer -->
<?php  require_once './includes/footer.php' ?>