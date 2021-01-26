<?php
    include('conexion.php');
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            clear_token();
            break;
        
        default:
            $respuesta = array();
            $respuesta['correcto'] = false;
            echo json_encode($respuesta);
            die;
            break;
    }

    ///GET
    function clear_token()
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
        $consulta="UPDATE `usuario` SET `token` = NULL WHERE `usuario`.`idUsuario` =". $_GET['idUsuario'];
        mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);

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
