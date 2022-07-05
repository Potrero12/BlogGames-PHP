<?php require_once './includes/redireccion.php'?>
<?php require_once './includes/cabecera.php'?>
<?php require_once './includes/sidebar.php'?>
<?php require_once './includes/helper.php'?>

<!-- Contenido -->
<div id="principal">
    <h1>Mis Datos</h1>

    <form action="actualizarUsuario.php" method="POST">

    <!-- mostrar errores -->
        <?php if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?php echo $_SESSION['completado']; ?>
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-exito">
                <?php echo $_SESSION['errores']['general']; ?>
            </div>
        <?php endif; ?>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre']?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
        
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" value="<?=$_SESSION['usuario']['apellido']?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?=$_SESSION['usuario']['email']?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>


        <input type="submit" value="Actualizar Información" name="submitMisDatos"/>

    </form>
    <?php borrarErrores() ?>

</div>

<!-- footer -->
<?php  require_once './includes/footer.php' ?>