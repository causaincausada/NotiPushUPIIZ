<?php
    include 'conexion.php';

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            get_Usuarios();
            break;
        
        case 'POST':
            alta_Usuario();
            break;
        
        case 'PUT':
            actualizar_Usuario();
            break;

        case 'DELETE':
            borrar_Usuario();
            break;

        default:
            echo json_encode($respuesta);
            die;
            break;
    }

    ///GET
    function get_Usuarios()
    {
        $respuesta = array();
        $respuesta['correcto']= false;

        $link=connect();
        $consulta="SELECT * FROM `usuario`";
        $resultado = mysqli_query($link, $consulta) or error_Consulta();
        mysqli_close($link);
    
        $usuarios = array();
        while ($usuario = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $usuario;
        }
    
        $respuesta['usuarios'] = array();
        $respuesta['usuarios'] = $usuarios;
        $respuesta['correcto'] = true;
        echo json_encode($respuesta);
        die;
    }

    ///POST
    function alta_Usuario()
    {

    }

    ///PUT
    function actualizar_Usuario()
    {

    }

    ///DELETE
    function borrar_Usuario()
    {
        $respuesta = array();
        $respuesta['correcto']= false;

        if (!isset($_GET['idUsuario'])) {
            echo json_encode($respuesta);
            die;
        }

        $idUsuario = $_GET['idUsuario'];

        $link=connect();
        $consulta= "DELETE FROM `usuario` WHERE `idUsuario` = $idUsuario " ;
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