<?php
    include('conexion.php');
    $respuesta = array();
    $link=connect();
    $respuesta['correcto']='0';
    if(isset($_POST['nombre']) && isset($_POST['descripcion'])){
        $link=connect();
        $sentencia="INSERT INTO `grupo` (`idGrupo`, `nombre`, `descripcion`) VALUES (NULL, '".$_POST['nombre']."', '".$_POST['descripcion']."')";
        $BD= mysqli_query($link, $sentencia);
        $respuesta['correcto']='1';
    }
    echo json_encode($respuesta);
?>