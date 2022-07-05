<?php require_once './includes/redireccion.php'?>
<?php require_once './includes/cabecera.php'?>

<?php 
    $entrada = conseguirEntrada($db, $_GET['id']);
    if(!isset($entrada['id'])){
        header('location:index.php');
    }
?>

<?php require_once './includes/sidebar.php'?>
<?php require_once './includes/helper.php'?>

<!-- Contenido -->
<div id="principal">
    <h1>Editar Entrada</h1>

    <form action="guardarEntradas.php?editar=<?=$entrada['id']?>" method="POST">

        <p>Editando Entrada <strong><?=$entrada['titulo']?></strong></p>
        <br />

        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" value="<?=$entrada['titulo']?>"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>
        
        <label for="categoria">Categoria</label>
        <select name="categoria">
            <option value="">Seleccione una Categoria</option>
            <<?php $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
                while($categoria  = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?=$categoria['id']?>" <?=($categoria['id'] == $entrada['categoria_id']) ? 'selected="selected"' : '' ?> ><?=$categoria['nombre']?></option>
            <?php endwhile; 
                  endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" cols="144" rows="10"><?=$entrada['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

        <input type="submit" value="Guardar" name="crearEntrada"/>
    </form>
    <?php borrarErrores();?>
</div>

<!-- footer -->
<?php  require_once './includes/footer.php' ?>