<?php 
    

    require_once './includes/helper.php'
?>

<!-- sidebar -->
<aside id="sidebar">
    
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id = "usuario-logueado" class="bloque">
            <h3>Bienvenido <?= $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellido']?></h3>
            <!-- botones -->
            <a href="crearEntradas.php" class="boton boton-verde">Crear Entradas</a>
            <a href="crearCategoria.php" class="boton">Crear Categorias</a>
            <a href="cerrarSesion.php" class="boton boton-naranja">Mis Datos</a>
            <a href="cerrarSesion.php" class="boton boton-rojo">Cerrar Sesion</a>
        </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['usuario'])): ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>

            <?php if(isset($_SESSION['error_login'])): ?>
                <div class="alerta alerta-error">
                    <?=$_SESSION['error_login'];?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">

                <label for="email">Email</label>
                <input type="email" name="email"/>

                <label for="password">Contraseña</label>
                <input type="password" name="password"/>

                <input type="submit" value="Ingresar" name="submitL"/>

            </form>
        </div>

        <div id="register" class="bloque">

            <h3>Registrate</h3>
            <form action="register.php" method="POST">

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
                <input type="text" name="nombre"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
                
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

                <label for="email">Email</label>
                <input type="email" name="email"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

                <input type="submit" value="Registro" name="submitR"/>

            </form>
            <?php borrarErrores() ?>
        </div>
    <?php endif; ?>
</aside>