<?php
    include('conexion.php');
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            get_Notificacion();
            break;
        
        case 'POST':
            alta_Notificacion();
            break;

        default:
            echo json_encode($respuesta);
            die;
            break;
    }

    ///GET
    function get_Notificacion()
    {
        $respuesta = array();
        $respuesta['correcto'] = false;
        if (isset($_GET['idNotificacion'])) {
            $idNotificacion = $_GET['idNotificacion'];
            $link=connect();
            $consulta="SELECT * FROM `notificacion` WHERE `idNotificacion` = " . $idNotificacion;
            $resultado = mysqli_query($link, $consulta) or error_Consulta();
            mysqli_close($link);
    
            $notificaciones = array();
            while ($notificacion = mysqli_fetch_assoc($resultado)) {
                $notificaciones[] = $notificacion;
            }
    
            $respuesta['notificaciones'] = array();
            $respuesta['notificaciones'] = $notificaciones;
            $respuesta['correcto'] = true;
            echo json_encode($respuesta);
            die;
        }
    
        $link=connect();
        $consulta="SELECT * FROM `notificacion`";
        $resultado = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
    
        $notificaciones = array();
        while ($notificacion = mysqli_fetch_assoc($resultado)) {
            $notificaciones[] = $notificacion;
        }
    
        $respuesta['notificaciones'] = array();
        $respuesta['notificaciones'] = $notificaciones;
        $respuesta['correcto'] = true;
        echo json_encode($respuesta);
        die;
    }
    
    ///POST
    function alta_Notificacion()
    {
        $respuesta = array();
        $respuesta['correcto'] = false;
        $link=connect();
    
        $d = file_get_contents("php://input");
        $datos = json_decode($d);

        if (empty($d)) {
            echo json_encode($respuesta);
            die;
        }

        if (!isset($datos->titulo) || !isset($datos->descripcion) || !isset($datos->fecha) || !isset($datos->Grupo_idGrupo)) {
            echo json_encode($respuesta);
            die;
        }

        $titulo = $datos->titulo;
        $descripcion = $datos->descripcion;
        $fecha = $datos->fecha;
        $Grupo_idGrupo = $datos->Grupo_idGrupo;

        $sentencia="INSERT INTO `notificacion` (`idNotificacion`, `titulo`, `descripcion`, `fecha`, `Grupo_idGrupo`) VALUES (NULL, '".$titulo."', '".$descripcion."', '".$fecha."', '".$Grupo_idGrupo."')";
        $BD= mysqli_query($link, $sentencia) or error_Consulta();
        $respuesta['correcto']= true;
        echo json_encode($respuesta);
    }

    function error_Consulta()
    {
        $respuesta = array();
        $respuesta['correcto'] = false;
        echo json_encode($respuesta);
        die;
    }
