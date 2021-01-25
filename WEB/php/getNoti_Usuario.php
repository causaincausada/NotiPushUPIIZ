<?php
    include('conexion.php');
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            get_Notificacion();
            break;
        
        default:
            $respuesta = array();
            $respuesta['correcto'] = false;
            echo json_encode($respuesta);
            die;
            break;
    }

    ///GET
    function get_Notificacion()
    {
        $respuesta = array();
        $respuesta['correcto'] = false;
        if (!isset($_GET['idUsuario'])) {
            $respuesta = array();
            $respuesta['correcto'] = false;
            echo json_encode($respuesta);
            die;
        }

        if ($idUsuario = "") {
            $respuesta = array();
            $respuesta['correcto'] = false;
            echo json_encode($respuesta);
            die;
        }
    
        $link=connect();
        $consulta="SELECT * FROM notificacion WHERE `Grupo_idGrupo` IN (SELECT `Grupo_idGrupo` FROM `agrupamiento` WHERE `Usuario_idUsuario` = ". $_GET['idUsuario'] .") ORDER BY `fecha` DESC";
        $resultado = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
    
        $notificaciones = array();
        while ($notificacion = mysqli_fetch_assoc($resultado)) {
            $notificaciones[] = $notificacion;
        }
    
        $respuesta['notificaciones'] = array();
        $respuesta['notificaciones'] = $notificaciones;

        $link=connect();
        $consulta="SELECT * FROM `grupo`";
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
    
    function error_Consulta()
    {
        $respuesta = array();
        $respuesta['correcto'] = false;
        echo json_encode($respuesta);
        die;
    }