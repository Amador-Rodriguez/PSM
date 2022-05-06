<?php
 include("login-contr.classes.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $datos_k = json_decode(file_get_contents('php://input'), true);


        $email = $datos_k['correo'];
        $pass = $datos_k['pwd'];
        
        $login = new LoginContr("$email", "$pass");
        $error = $login->loginUser();
        //echo "Conexion exitosa";
        //header("location: ../index.php?error=none");

        //$error = 0;
        //$mensaje = "Conexion exitosa";  
        $datos = 0;

        switch ($error){
            case 0:{
                $mensaje = "Conexion exitosa";
                break;
            }
            case 1:{
                $mensaje = "Error de ejecución";
                break;
            }
            case 2:{
                $mensaje = "Usuario no encontrado";
                break;
            }
            case 3:{
                $mensaje = "Contraseña incorrecta";
                break;
            }

        }

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