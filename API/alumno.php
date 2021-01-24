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
        if (!isset($_GET['boleta'])) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Faltan parámetros";
            echo json_encode($respuesta);
            die;
        }

        $boleta = $_GET['boleta'];

        if ($boleta == "") {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Algún parámetro esta vacío";
            echo json_encode($respuesta);
            die;
        }
        
        existe_alumno($boleta);
        $respuesta['encontrado'] = true;

        $link=connect();
        $consulta="SELECT * FROM `alumno` WHERE `boleta` LIKE "."'". $boleta ."'";
        $r = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
        $rows = array();
        while ($a = mysqli_fetch_assoc($r)) {
            $rows[] = $a;
        }

        $respuesta['error'] = false;
        $respuesta['data_alumno'] = $rows;
        echo json_encode($respuesta);
    }

    function error_Consulta()
    {
        $respuesta['error'] = true;
        $respuesta['error_Mensaje'] = "Error al ejecutar la consulta";
        echo json_encode($respuesta);
        die;
    }

    function existe_alumno($boleta)
    {
        $link=connect();
        $consulta="SELECT COUNT(*) FROM `alumno` WHERE `boleta` LIKE '". $boleta ."'";
        $r = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);

        $r2 = mysqli_fetch_array($r);
        $total = $r2['COUNT(*)'];

        if ($total < 1) {
            $respuesta['encontrado'] = false;
            $respuesta['error'] = false;
            echo json_encode($respuesta);
            die;
        }
    }