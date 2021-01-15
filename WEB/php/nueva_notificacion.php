<?php
    include('conexion.php');
    $respuesta = array();
    $link=connect();
    $respuesta['correcto']='0';
    if(isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['fecha']) && isset($_POST['Grupo_idGrupo']) ){
        $link=connect();
        $sentencia="INSERT INTO `grupo` (`idNotiicacion`, `titulo`, `descripcion`, `fecha`, `Grupo_idGrupo`) VALUES (NULL, '".$_POST['titulo']."', '".$_POST['descripcion']."', '".$_POST['fecha']."', '".$_POST['Grupo_idGrupo']."')";
        $BD= mysqli_query($link, $sentencia);
        $respuesta['correcto']='1';
    }
    echo json_encode($respuesta);
?>