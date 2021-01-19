<?php
    include('conexion.php');
    switch ($_SERVER['REQUEST_METHOD']){
        case 'GET':
            traer_agrupamiento();
            break;
        case 'POST':
            alta_agrupamiento();
            break;
        case 'DELETE':
            eliminar_agrupamiento();
            break;
        default:
            $respuesta = array();
            $respuesta['correcto']= false;
            echo json_encode($respuesta);
            die;
            break;
    }
    function traer_agrupamiento(){
        $respuesta = array();
        $respuesta['correcto']= false;
        $Grupo_idGrupo=$_GET['Grupo_idGrupo'];
        $link=connect();
        $consulta="SELECT `idUsuario`, `nombrecompleto`, `tipo` FROM `agrupamiento` INNER JOIN `usuario` ON `Grupo_idGrupo`= ".$Grupo_idGrupo." AND `idUsuario` = `Usuario_idUsuario`";
        $resultado = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
    
        $grupos = array();
        while ($grupo = mysqli_fetch_assoc($resultado)) {
            $grupos[] = $grupo;
        }
    
        $respuesta['grupos'] = array();
        $respuesta['grupos'] = $grupos;
        $respuesta['correcto'] = true;
        echo json_encode($respuesta);
        die;
    }
    function alta_agrupamiento(){
        $respuesta = array();
        $respuesta['correcto'] = false;
        
        $d = file_get_contents("php://input");
        $datos = json_decode($d);

        if (empty($d)) {
            echo json_encode($respuesta);
            die;
        }

        if (!isset($datos->Usuario_idUsuario) || !isset($datos->Grupo_idGrupo)) {
            echo json_encode($respuesta);
            die;
        }

        $idUsuario = $datos->Usuario_idUsuario;
        $idGrupo= $datos->Grupo_idGrupo;

        $link=connect();
        $consulta="INSERT INTO `agrupamiento` (`Usuario_idUsuario`, `Grupo_idGrupo`) VALUES ('".$idUsuario."', '".$idGrupo."')";
        mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
        $respuesta['correcto']= true;
        echo json_encode($respuesta);
    }
    function eliminar_agrupamiento(){
        $respuesta = array();
        $respuesta['correcto']=false;

        if(!isset($_GET['Usuario_idUsuario']) && !isset($_GET['Grupo_idGrupo'])){
            echo json_encode($respuesta);
            die;
        }
        $idUsuario= $_GET['Usuario_idUsuario'];
        $idGrupo= $_GET['Grupo_idGrupo'];

        $link=connect();
        $consulta= "DELETE FROM `agrupamiento` WHERE `Usuario_idUsuario` = ".$idUsuario." AND `Grupo_idGrupo`= ".$idGrupo."";
        mysqli_query($link, $consulta) or error_Consulta();

        if (mysqli_affected_rows($link) < 1) {
            mysqli_close($link);
            echo json_encode($respuesta);
            die;
        }

        mysqli_close($link);

        $respuesta['correcto']= true;
        echo json_encode($respuesta);
        die;
    }

    function error_Consulta()
    {
        $respuesta = array();
        $respuesta['correcto']= false;
        echo json_encode($respuesta);
        die;
    }
?>