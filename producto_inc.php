<?php
 include("product-contr.classes.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $datos_k = json_decode(file_get_contents('php://input'), true);


        $email = $datos_k['correo'];
        $pass = $datos_k['pwd'];
        
        $login = new LoginContr("$email", "$pass");
        $data = $login->loginUser();
        $id_user = $data[0];
        $name = $data[1];
        $mail = $data[2];
        $error = $data[3];
        //echo "Conexion exitosa";
        //header("location: ../index.php?error=none");

        //$error = 0;
        //$mensaje = "Conexion exitosa";  
        

        switch ($error){
            case 0:{
                $mensaje = "Login exitoso";
                break;
            }
            case 1:{
                $mensaje = "Error del servidor";
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
            "id_user"=>$id_user,
            "name"=>$name,
            "mail"=>$mail
        ];
        header('Content-Type: application/json');

        echo json_encode($resp);

    }else{
        echo "error";
    }

?>