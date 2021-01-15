<?php
    include('conexion.php');
    $link=connect();
    $respuesta = array();
    $respuesta['correcto']='0';
    $respuesta['grupos']=array();
    $sentencia="SELECT * FROM `grupo`";
    $BD= mysqli_query($link, $sentencia);
    $filas= array();
    while ($fila=mysqli_fetch_assoc($BD)){
        $filas['idGrupo']=$fila['idGrupo'];
        $filas['nombre']=$fila['nombre'];
        $filas['descripcion']=$fila['descripcion'];
        array_push($respuesta['grupos'], $filas );
    }
    $respuesta['correcto']='1';
    echo json_encode($respuesta);

?>