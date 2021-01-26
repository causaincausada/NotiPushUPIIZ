<?php
    function connect()
    {
        $servidor = "localhost";
        $usuario  = "root";
        $clave    = "";
        $base     = "api_notipushupiiz";
    
        $conexion = mysqli_connect($servidor, $usuario, $clave, $base);

        if (!$conexion) {
            $respuesta['error'] = true;
            $respuesta['error_Mensaje'] = "No se pudo conectar a MySQL";
            echo json_encode($respuesta);
            die;
        }
    
        return $conexion;
    }