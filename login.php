<?php 

    // verificamos que se envie el submit completo
    if(isset($_POST['submitL'])){

        require_once './includes/conexion.php';

        // borrar el error sesion antigua
        if(isset($_SESSION['error_login'])){
            session_unset($_SESSION['error_login']);
        }

        // capturamos los valores del formulario y validamos que venga por medio de un ternario
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

        // array de errores;
        $errores = [];


        // validamos el email
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_validado = true;
        } else {
            $email_validado = false;
            $errores['email'] = 'El Email no es Valido';
        }

        // comprobar que exista el usuario
        $sql = "select * from usuarios where email = '$email'";
        $login = mysqli_query($db, $sql);

        if($login && mysqli_num_rows($login) == 1){
            $usuario = mysqli_fetch_assoc($login);
            
            // validar la contraseña cifrada
            $verify = password_verify($password, $usuario['password']);

            if($verify){
                // creamos una sesion usuario para guardar todos los datos del usuario
                $_SESSION['usuario'] = $usuario;

            } else {
                // mensaje de error
                $_SESSION['error_login'] = "Datos ingresados no son correctos";

            }
        } else {
            // mensaje de error
            $_SESSION['error_login'] = "Error En El Inicio De Sesion";
        }

    }

    header('location:index.php');
?>