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

        $link=connect();//
        $sentencia="INSERT INTO `notificacion` (`idNotificacion`, `titulo`, `descripcion`, `fecha`, `Grupo_idGrupo`) VALUES (NULL, '".$titulo."', '".$descripcion."', '".$fecha."', '".$Grupo_idGrupo."')";
        $BD= mysqli_query($link, $sentencia) or error_Consulta();
        mysqli_close($link);//

        $link=connect();//
        $consulta="SELECT `token` FROM `usuario` WHERE 1";
        $resultado = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
    
        $notificaciones = array();
        while ($notificacion = mysqli_fetch_assoc($resultado)) {
            $notificaciones[] = $notificacion;
        }

        $n = array();

        foreach ($notificaciones as &$valor) {
            $n[] = $valor['token'];
        }

        $a = "fAcsIVxlQoiGmIXo2_RTdm:APA91bEfpL3fchyZCXSTBKTpm977haAXxC7WkBY970aN0_9pTV0oUDoYnhIMVd8NYMUkY-w3tw1eO";
        //sendGCM($descripcion, $a);

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

    function sendGCM($message, $id) {
        $url = 'https://fcm.googleapis.com/fcm/send';
    
        $fields = array (
                'registration_ids' => array (
                        $id
                ),
                'data' => array (
                        "message" => $message
                )
        );
        $fields = json_encode ( $fields );
    
        $headers = array (
                'Authorization: key=' . "AAAAoxvhfTo:APA91bF9m8ikib4SLpguPhSMqZRMfinxrRjL7qCcNE3fgQs7FH_H5qc3A6xTbdx-BKSgW3Ojcx-OEF5GVlxuUmAofKYnCQbGY8zOR3Uykm9rJzWY6u6l9aeZmlDpkMcTvNincpVEjF0R",
                'Content-Type: application/json'
        );
    
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
    
        $result = curl_exec ( $ch );
        echo $result;
        curl_close ( $ch );
    }