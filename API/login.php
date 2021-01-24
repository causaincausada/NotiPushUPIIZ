<?php
    $respuesta = array();
    include 'conexion.php';

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            validar_Password();
            break;
        
        default:
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Método de solicitud no válido";
            echo json_encode($respuesta);
            die;
            break;
    }

    function validar_Password()
    {
        if (!isset($_GET['usuario']) || !isset($_GET['clave'])) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Faltan parámetros";
            echo json_encode($respuesta);
            die;
        }

        $usuario = $_GET['usuario'];
        $clave = $_GET['clave'];

        if ($usuario == "" || $clave == "") {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Algún parámetro esta vacío";
            echo json_encode($respuesta);
            die;
        }
        
        existe_Usuario($usuario);

        $link=connect();
        $consulta="SELECT `clave` FROM `credenciales` WHERE `usuario` LIKE "."'". $usuario ."'";
        $r = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);

        $r2 = mysqli_fetch_array($r);
        $real_Password = $r2['clave'];

        if ($clave == $real_Password) {
            $respuesta['correct_Password'] = true;
        } else {
            $respuesta['correct_Password'] = false;
        }

        $respuesta['error'] = false;
        echo json_encode($respuesta);
    }

    function error_Consulta()
    {
        $respuesta['error'] = true;
        $respuesta['error_Mensaje'] = "Error al ejecutar la consulta";
        echo json_encode($respuesta);
        die;
    }

    function existe_Usuario($usuario)
    {
        $link=connect();
        $consulta="SELECT COUNT(*) FROM `credenciales` WHERE `usuario` LIKE '". $usuario ."'";
        $r = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);

        $r2 = mysqli_fetch_array($r);
        $total = $r2['COUNT(*)'];

        if ($total < 1) {
            $respuesta['correct_Password'] = false;
            $respuesta['error'] = false;
            echo json_encode($respuesta);
            die;
        }
    }