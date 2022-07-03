
<!-- Cabecera - menu  -->
<?php 
    require_once './includes/cabecera.php'
?>

<!-- contenido lateral  -->
<?php require_once './includes/sidebar.php'?>

<!-- Contenido -->
<div id="principal">
    <h1>Ultimas Entradas</h1>

    
    <!-- usar el while para recorrer los arrays de las consultas -->
    <?php $entradas = conseguirUltimasEntradas($db);
        if(!empty($entradas)):
            while($entrada = mysqli_fetch_assoc($entradas)): 
        ?>
            <article class="entrada">
                <a href="#">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                    <p><?=substr($entrada['descripcion'], 0, 300)."..."?></p>
                </a>               
            </article>
        <?php
            endwhile;
        endif; 
    ?>
    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</A>
    </div>
</div>

<!-- footer -->
<?php  require_once './includes/footer.php' ?>
