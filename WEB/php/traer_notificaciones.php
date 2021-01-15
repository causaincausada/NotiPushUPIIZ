<?php
    include('conexion.php');
    $link=connect();
    $respuesta = array();
    $respuesta['correcto']='0';
    $respuesta['Notificaciones']=array();
    $sentencia="SELECT * FROM `Notificacion`";
    $BD= mysqli_query($link, $sentencia);
    $filas= array();
    while ($fila=mysqli_fetch_assoc($BD)){
        $filas['idNotificacion']=$fila['idNotificacion'];
        $filas['titulo']=$fila['titulo'];        
        $filas['descripcion']=$fila['descripcion'];
        $filas['fecha']=$fila['fecha'];
        $filas['Grupo_idGrupo']=$fila['Grupo_idGrupo'];
        array_push($respuesta['Notificaciones'], $filas );
    }
    $respuesta['correcto']='1';
    echo json_encode($respuesta);

?>
