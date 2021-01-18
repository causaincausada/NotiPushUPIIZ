<?php
    include('conexion.php');
    $respuesta = array();
    $link=connect();
    $respuesta['correcto']='0';
    if(isset($_GET['titulo']) && isset($_GET['descripcion']) && isset($_GET['fecha']) && isset($_GET['Grupo_idGrupo']) ){
        $sentencia="INSERT INTO `grupo` (`idNotificacion`, `titulo`, `descripcion`, `fecha`, `Grupo_idGrupo`) VALUES (NULL, '".$_GET['titulo']."', '".$_GET['descripcion']."', '".$_GET['fecha']."', '".$_GET['Grupo_idGrupo']."')";
        $BD= mysqli_query($link, $sentencia);
        $respuesta['correcto']='1';
    }
    echo json_encode($respuesta);
?>