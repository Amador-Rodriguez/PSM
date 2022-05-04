<?php
 include("login-contr.classes.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $datos_k = json_decode(file_get_contents('php://input'), true);


        $email = $datos_k['correo'];
        $pass = $datos_k['pwd'];
        
        $login = new LoginContr("$email", "$pass");
        $mensaje = $login->loginUser();
        //echo "Conexion exitosa";
        //header("location: ../index.php?error=none");

        $error = 0;
        //$mensaje = "Conexion exitosa";  
        $datos = 0;

        $resp = [
            "error"=>$error,
            "mensaje"=>$mensaje,
            "datos"=>$datos
        ];

        echo json_encode($resp);

    }else{
        echo "error";
    }

?>