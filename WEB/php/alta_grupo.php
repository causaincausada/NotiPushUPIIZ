<?php
    include('conexion.php');
    $respuesta = array();
    $link=connect();
    $respuesta['correcto']='0';
    if(isset($_GET['nombre']) && isset($_GET['descripcion'])){
        $link=connect();
        $sentencia="INSERT INTO `grupo` (`idGrupo`, `nombre`, `descripcion`) VALUES (NULL, '".$_GET['nombre']."', '".$_GET['descripcion']."')";
        $BD= mysqli_query($link, $sentencia);
        $respuesta['correcto']='1';
    }
    echo json_encode($respuesta);
?>