<?php 
    if(isset($_POST['crearEntrada'])){

        // cargamos la conexion db
        require_once './includes/conexion.php';

        $titulo = isset(($_POST['titulo'])) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
        $categoria = isset(($_POST['categoria'])) ? (int)$_POST['categoria'] : false;
        $descripcion = isset(($_POST['descripcion'])) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
        $usuarioId = (int)$_SESSION['usuario']['id'];
        

        // array de errores;
        $errores = [];

        // validar los datos antes de guardarlos
        if(!empty($titulo) && !is_numeric($titulo)) {
            $titulo_valido = true;
        } else {
            $titulo_valido = false;
            $errores['titulo'] = 'El Titulo no es Valido';
        }

        // validar los datos antes de guardarlos
        if(!empty($categoria) && is_numeric($categoria)) {
            $categoria_Valida = true;
        } else {
            $categoria_Valida = false;
            $errores['categoria'] = 'La Categoria no es Valido';
        }

        // validar los datos antes de guardarlos
        if(!empty($descripcion) && !is_numeric($descripcion)) {
            $descripcion_valida = true;
        } else {
            $descripcion_valida = false;
            $errores['descripcion'] = 'La Descripcion no es Valida';
        }


        if(count($errores) === 0) {
            $sql = "INSERT INTO entradas VALUES (null, $usuarioId, $categoria, '$titulo', '$descripcion', CURDATE())";
            $guardar = mysqli_query($db, $sql);


            if($guardar){
                $_SESSION['completado'] = 'Entrada creada correctamente';
                header('location:index.php');
            } 
        } else {
            $_SESSION['errores_entrada'] = $errores;
            header('location:crearEntradas.php');
        }

    }
?>