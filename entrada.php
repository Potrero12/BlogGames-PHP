<!-- Cabecera - menu  -->
<?php 
    require_once './includes/cabecera.php'
?>

<?php 
    $entrada = conseguirEntrada($db, $_GET['id']);
    if(!isset($entrada['id'])){
        header('location:index.php');
    }
?>

<!-- contenido lateral  -->
<?php require_once './includes/sidebar.php'?>

<!-- Contenido -->
<div id="principal">
    <article class="entrada">
        <a href="categoria.php?id=<?=$entrada['categoria_id']?>">
            <h2><?=$entrada['titulo']?></h2>
        </a>
            <span class="fecha"><?=$entrada['Autor']?> |</span>
            <span class="fecha"><?=$entrada['categoria']?> | <?=$entrada['fecha']?></span>
        <p><?=$entrada['descripcion']?></p>
    </article>

    <?php  if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada['usuario_id']): ?>
            <a href="editarEntrada.php?id=<?=$entrada['id']?>"" class="boton boton-verde">Editar Entrada</a>
            <a href="borrarEntrada.php?id=<?=$entrada['id']?>" class="boton">Borrar Entrada</a>
    <?php endif; ?>
</div>

<!-- footer -->
<?php  require_once './includes/footer.php' ?>