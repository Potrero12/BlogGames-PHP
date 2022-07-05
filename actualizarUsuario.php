<?php 
    if(isset($_POST['submitMisDatos'])){

        // cargamos la conexion db
        require_once './includes/conexion.php';

        $nombre = isset(($_POST['nombre'])) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellido = isset(($_POST['apellido'])) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
        $email = isset(($_POST['email'])) ? mysqli_real_escape_string($db, $_POST['email']) : false;
        $idUsuario = (int)$_SESSION['usuario']['id'];

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

        // guardar en la db
        if(count($errores) === 0){

            // comprobar si el email ya existe
            $sql  = "SELECT id, email FROM usuarios WHERE email = '$email'";
            $email_DB = mysqli_query($db, $sql);
            $isset_user = mysqli_fetch_assoc($email_DB);
            if($isset_user['id'] == $idUsuario || empty($isset_user)){

                // insertar el nuevo usuario
                $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', email = '$email' where id = $idUsuario";
                $actualizar = mysqli_query($db, $sql);
    
                if($actualizar){
                    // si se actualiza bien, tambien actualizamos la sesion del usuario con los nuevos datos
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellido'] = $apellido;
                    $_SESSION['usuario']['email'] = $email;
                    $_SESSION['completado'] = 'Usuario Actualizado correctamente';
                    header('location: misDatos.php');
    
                } else {
                    $_SESSION['errores']['general'] = "Fallo al actualizar el usuario";
                }
            } else {
                $_SESSION['errores']['general'] = "Ya existe un usuario con ese Email";
                header('location: misDatos.php');
            }
            
            
        } else {
            
            $_SESSION['errores'] = $errores;
            header('location: misDatos.php');

        }
    }
?>