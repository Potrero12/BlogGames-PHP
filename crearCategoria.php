<?php require_once './includes/redireccion.php'?>
<?php require_once './includes/cabecera.php'?>
<?php require_once './includes/sidebar.php'?>
<?php require_once './includes/helper.php'?>

<!-- Contenido -->
<div id="principal">
    <h1>Crear Categorias</h1>

    <form action="guardarCategoria.php" method="POST">

        <p>Añade nuevas categorias al blog</p>
        <br />

        <label for="nombre">Nombre de Categoria</label>
        <input type="text" name="nombre" />
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

        <input type="submit" value="Crear Categoria" name="crearCa"/>
    </form>
</div>


<!-- footer -->
<?php  require_once './includes/footer.php' ?>