<?php

    require_once './includes/conexion.php';

    function mostrarError($errores, $campo){
        $alerta = "";
        if(isset($errores[$campo]) && !empty($campo)) {
            $alerta = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
        }

        return $alerta;
    }

    function borrarErrores(){
        $borrado = false;
        if(isset($_SESSION['errores'])){
            $_SESSION['errores'] = null;
            $borrado = true;
        }

        if(isset($_SESSION['errores_entrada'])){
            $_SESSION['errores_entrada'] = null;
            $borrado = true;
        }

        if(isset($_SESSION['completado'])){
            $_SESSION['completado'] = null;
            $borrado = true;
        }
 
        return $borrado;
    }

    function conseguirCategorias($conexion){
        $sql = "SELECT * FROM categorias ORDER BY id ASC";
        $categorias = mysqli_query($conexion, $sql);
    
        $resultado = array();
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $resultado = $categorias;
        }
        
        return $resultado;
    
    }

    function conseguirCategoria($conexion, $id){
        $sql = "SELECT * FROM categorias WHERE id = $id";
        $categorias = mysqli_query($conexion, $sql);
    
        $resultado = array();
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $resultado = mysqli_fetch_assoc($categorias);
        }
        
        return $resultado;
    
    }

    function conseguirEntrada($conexion, $id){
        $sql = "SELECT e.*, c.nombre as 'categoria', CONCAT(u.nombre, ' ', u.apellido) as 'Autor' FROM entradas e 
                INNER JOIN categorias c ON c.id = e.categoria_id
                INNER JOIN usuarios u ON u.id = e.usuario_id
                WHERE e.id = $id";

        $entrada = mysqli_query($conexion, $sql);
    
        $resultado = array();
        if($entrada && mysqli_num_rows($entrada) >= 1){
            $resultado = mysqli_fetch_assoc($entrada);
        }
        
        return $resultado;
    
    }

    function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){
        $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e
                INNER JOIN categorias c ON c.id = e.categoria_id ";

        if(!empty($categoria) && is_int($categoria)){
            $sql .= "WHERE e.categoria_id = $categoria ";
        }

        if(!empty($busqueda)){
            $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
        }

        $sql .= "ORDER BY e.id DESC ";

        if($limit){
            $sql .= "LIMIT 4";
        }

        $entradas = mysqli_query($conexion, $sql);

        $resultado = array();
        if($entradas && mysqli_num_rows($entradas) >= 1){
            $resultado = $entradas;
        }

        return $resultado;

    }

?>