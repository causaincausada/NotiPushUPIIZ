<?php
    include 'conexion.php';

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            get_Grupos();
            break;
        
        case 'POST':
            alta_Grupo();
            break;
        
        case 'PUT':
            actualizar_Grupo();
            break;

        case 'DELETE':
            borrar_Grupo();
            break;

        default:
            echo json_encode($respuesta);
            die;
            break;
    }

    ///GET
    function get_Grupos()
    {
        $respuesta = array();
        $respuesta['correcto']= false;

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

    ///POST
    function alta_Grupo()
    {
        $respuesta = array();
        $respuesta['correcto'] = false;
        
        $d = file_get_contents("php://input");
        $datos = json_decode($d);

        if (empty($d)) {
            echo json_encode($respuesta);
            die;
        }

        if (!isset($datos->nombre) || !isset($datos->descripcion)) {
            echo json_encode($respuesta);
            die;
        }

        $nombre = $datos->nombre;
        $descripcion= $datos->descripcion;

        $link=connect();
        $consulta="INSERT INTO `grupo` (`idGrupo`, `nombre`, `descripcion`) VALUES (NULL, '".$nombre."', '".$descripcion."')";
        mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
        $respuesta['correcto']= true;
        echo json_encode($respuesta);
    }

    ///PUT
    function actualizar_Grupo()
    {
        $respuesta = array();
        $respuesta['correcto']= false;
        if (!isset($_GET['ID'])) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Falta ID";
            echo json_encode($respuesta);
            die;
        }

        $ID = $_GET['ID'];

        if ($ID == "") {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "El parámetro ID esta vacío";
            echo json_encode($respuesta);
            die;
        }

        $d = file_get_contents("php://input");
        $datos = json_decode($d);

        if (empty($d)) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Faltan datos";
            echo json_encode($respuesta);
            die;
        }

        if (!isset($datos->Nombre) || !isset($datos->Usuario) || !isset($datos->Contrasena)) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Faltan parámetros";
            echo json_encode($respuesta);
            die;
        }

        $Nombre = $datos->Nombre;
        $Usuario = $datos->Usuario;
        $Contrasena = $datos->Contrasena;

        if ($Nombre == "" || $Usuario == "" || $Contrasena == "") {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Algún parámetro esta vacío";
            echo json_encode($respuesta);
            die;
        }

        $link=connect();
        $consulta="UPDATE `empleados` SET `Nombre` = '". $Nombre ."', `Usuario` = '". $Usuario ."', `Contrasena` = '". $Contrasena ."' WHERE `empleados`.`ID` = " . $ID;
        mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
        $respuesta['error'] = false;
        echo json_encode($respuesta);
    }

    ///DELETE
    function borrar_Grupo()
    {
        $respuesta = array();
        $respuesta['correcto']= false;

        if (!isset($_GET['ID'])) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Falta ID";
            echo json_encode($respuesta);
            die;
        }

        $ID = $_GET['ID'];

        if ($ID == "") {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Algún parámetro esta vacío";
            echo json_encode($respuesta);
            die;
        }

        $link=connect();
        $consulta= "DELETE FROM `empleados` WHERE `empleados`.`ID` =" . $ID;
        mysqli_query($link, $consulta) or error_Consulta();
        
        if (mysqli_affected_rows($link) < 1) {
            mysqli_close($link);
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "No se eliminó o el usuario no existe en la base de datos";
            echo json_encode($respuesta);
            die;
        }
        
        mysqli_close($link);

        $respuesta['error'] = false;
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
