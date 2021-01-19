<?php
    $respuesta=array();
    $respuesta['correcto']= false;
    if(!isset($_GET['usuario']) && !isset($_GET['clave'])){
        echo json_encode($respuesta);
        die;
    }

    $usuario=$_GET['usuario'];
    $clave=$_GET['clave'];

    if($usuario==4545 && $clave==2343){
        $respuesta['correcto']=true;
        $respuesta['login']=true;
    }else{
        $respuesta['correcto']=true;
        $respuesta['login']=false;
    }
    echo json_encode($respuesta);
    die;
?>
