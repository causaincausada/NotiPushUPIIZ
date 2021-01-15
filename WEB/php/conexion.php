<?php
    function connect()
    {
        $servidor = "localhost";
        $usuario  = "u452640354_carlos";
        $clave    = "H9qA.Z7tpkvFNcH";
        $base     = "mydb";
    
        $conexion = mysqli_connect($servidor, $usuario, $clave, $base);

        if (!$conexion) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL; // IMPRIME MENSAJE DE ERROR PERSONALIZADO  Y SE TERMINA LA LÍNEA
            echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;// IDENTIFICA EL ERROR CON CÓDIGO O NOMBRE
            exit;
        }
    
        return $conexion;
    }
?>