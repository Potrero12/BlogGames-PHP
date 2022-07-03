<?php 
    if(isset($_POST['crearCa'])){

        // cargamos la conexion db
        require_once './includes/conexion.php';

        $nombre = isset(($_POST['nombre'])) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

        // array de errores;
        $errores = [];

        // validar los datos antes de guardarlos
        if(!empty($nombre) && !is_numeric($nombre)) {
            $nombre_validado = true;
        } else {
            $nombre_validado = false;
            $errores['nombre'] = 'El Nombre no es Valido';
        }

        if(count($errores) === 0) {
            $sql = "INSERT INTO categorias VALUES (null, '$nombre')";
            $guardar = mysqli_query($db, $sql);

            if($guardar){
                $_SESSION['completado'] = 'Categoria creada correctamente';
            } else {
                $_SESSION['errores']['general'] = "Fallo al crear categoria";
            }
        }

    }

    header('location:index.php');
?>