<!-- conexion base de datos -->
<?php 
    $server = 'localhost';
    $usuario = 'root';
    $password = '';
    $database = 'blog_master';

    try {
        $db = mysqli_connect($server, $usuario, $password, $database);

        mysqli_query($db, "SET NAME 'utf8'");

        if(mysqli_connect_errno()){
            echo "La conexion a la base de datos a fallado ".mysqli_connect_errno();
        };

        // comprobar si la existe una sesion iniciada
        if(!isset($_SESSION)){
            session_start();
        }

    } catch (\Throwable $e) {
        echo $e;
    }
?>