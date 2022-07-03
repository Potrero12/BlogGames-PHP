<?php

    // verificamos que se envie el submit completo
    if(isset($_POST['submitR'])){

        require_once './includes/conexion.php';

        if(!isset($_SESSION)){
            session_start();
        }

        // capturamos los valores del formulario y validamos que venga por medio de un ternario
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

        // array de errores;
        $errores = [];

        // validar los datos antes de guardarlos
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
            $nombre_validado = true;
        } else {
            $nombre_validado = false;
            $errores['nombre'] = 'El Nombre no es Valido';
        }

        if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
            $apellido_validado = true;
        } else {
            $apellido_validado = false;
            $errores['apellido'] = 'El Apellido no es Valido';
        }

        // validamos el email
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_validado = true;
        } else {
            $email_validado = false;
            $errores['email'] = 'El Email no es Valido';
        }

        // validar la contraseña
        if(!empty($password)) {
            $password_validado = true;
        } else {
            $password_validado = false;
            $errores['password'] = 'El Password esta Vacio';
        }

        $guardar_usuario = false;
        // guardar en la db
        if(count($errores) === 0){
            $guardar_usuario = true;
            
            // cifrar la contraseña
            $password_segura = password_hash($password, PASSWORD_BCRYPT, array('cost'=>4));
            
            // insertar el nuevo usuario
            $sql = "insert into usuarios values (null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE())";
            $guardar = mysqli_query($db, $sql);

            if($guardar){
                $_SESSION['completado'] = 'Usuario creado correctamente';
            } else {
                $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
            }
            
        } else {
            
            $_SESSION['errores'] = $errores;
            header('location: index.php');

        }
    }
    

?>