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
            $respuesta = array();
            $respuesta['correcto']= false;
            echo json_encode($respuesta);
            die;
            break;
    }

    ///GET
    function get_Usuarios()
    {
        $respuesta = array();
        $respuesta['correcto']= false;

        if (!isset($_GET['Grupo_idGrupo'])) {
            echo json_encode($respuesta);
            die;
        }

        $link=connect();
        $consulta="select * from usuario where usuario.idUsuario not in ( SELECT usuario.idUsuario FROM `agrupamiento` INNER JOIN `usuario` ON `Grupo_idGrupo`=". $_GET['Grupo_idGrupo'] ." AND `idUsuario` = `Usuario_idUsuario` )";
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
        $d = file_get_contents("php://input");
        $datos = json_decode($d);

        if (empty($d)) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Faltan datos";
            echo json_encode($respuesta);
            die;
        }

        if (!isset($datos->nombrecompleto) || !isset($datos->boleta) || !isset($datos->token) || !isset($datos->tipo) || !isset($datos->programa)) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Faltan parámetros";
            echo json_encode($respuesta);
            die;
        }

        $nombrecompleto = $datos->nombrecompleto;
        $boleta = $datos->boleta;
        $token = $datos->token;
        $tipo = $datos->tipo;
        $programa = $datos->programa;

        if ($nombrecompleto == "" || $boleta == "" || $token == "" || $tipo == "" || $programa == "") {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "Algún parámetro esta vacío";
            echo json_encode($respuesta);
            die;
        }
        
        $link=connect();
        $consulta="INSERT INTO programa(idPrograma, Nombre, Descripcion) SELECT NULL, '". $programa ."', NULL FROM dual WHERE NOT EXISTS( SELECT 1 FROM programa WHERE Nombre = '". $programa ."')";
        mysqli_query($link, $consulta) or error_Consulta2();
        mysqli_close($link);

        $link=connect();
        $consulta="SELECT `idPrograma` FROM `programa` WHERE `Nombre` LIKE '". $programa ."'";
        $r = mysqli_query($link, $consulta) or error_Consulta2();
        mysqli_close($link);

        $rows = array();
        while ($a = mysqli_fetch_assoc($r)) {
            $rows[] = $a;
        }
        $idPrograma = $rows[0]['idPrograma'];

        $link=connect();
        $consulta="INSERT INTO usuario(`idUsuario`, `nombrecompleto`, `boleta`, `token`, `tipo`, `Programa_idPrograma`) SELECT NULL, '". $nombrecompleto ."' , '". $boleta ."', '". $token ."', '". $tipo ."', ". $idPrograma ." FROM dual WHERE NOT EXISTS( SELECT 1 FROM usuario WHERE `boleta` = '" . $boleta ."')";
        mysqli_query($link, $consulta) or error_Consulta2();
        mysqli_close($link);
        
        $link=connect();
        $consulta="UPDATE `usuario` SET `token` = '". $token ."' WHERE `usuario`.`boleta` = '". $boleta ."'";
        mysqli_query($link, $consulta) or error_Consulta2();
        mysqli_close($link);

        $link=connect();
        $consulta="SELECT `idUsuario` FROM `usuario` WHERE `usuario`.`boleta` = '". $boleta ."'";
        $r2 = mysqli_query($link, $consulta) or error_Consulta2();
        mysqli_close($link);

        $rows2 = array();
        while ($a = mysqli_fetch_assoc($r2)) {
            $rows2[] = $a;
        }
        $idUsuario  = $rows2[0]['idUsuario'];

        $respuesta['error'] = false;
        $respuesta['idUsuario'] = $idUsuario;
        echo json_encode($respuesta);
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

    function error_Consulta2()
    {
        $respuesta = array();
        $respuesta['error'] = true;
        $respuesta['error_Mensaje'] = "Error en la consulta sql";
        echo json_encode($respuesta);
        die;
    }
