<!-- Cabecera - menu  -->
<?php 
    require_once './includes/cabecera.php'
?>

<?php 
    $categoria = conseguirCategoria($db, $_GET['id']);
    if(!isset($categoria['id'])){
        header('location:index.php');
    }
?>

<!-- contenido lateral  -->
<?php require_once './includes/sidebar.php'?>

<!-- Contenido -->
<div id="principal">
    <h1>Entradas de <?=$categoria['nombre']?></h1>

    <!-- usar el while para recorrer los arrays de las consultas -->
    <?php $entradas = conseguirEntradas($db, null, (int)$_GET['id']);
        if(!empty($entradas)):
            while($entrada = mysqli_fetch_assoc($entradas)):
        ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                    <p><?=substr($entrada['descripcion'], 0, 300)."..."?></p>
                </a>               
            </article>
        <?php
            endwhile; 
            else:
            ?>
            <div class="alerta">No hay entrada para esta categoria</div>    
        <?php 
            endif;
        ?>
        
        
</div>

<!-- footer -->
<?php  require_once './includes/footer.php' ?>