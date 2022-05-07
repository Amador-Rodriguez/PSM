<?php
 include("register-contr.classes.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $datos_k = json_decode(file_get_contents('php://input'), true);

        $nombre = $datos_k['nombre'];
        $apellidos = $datos_k['apellidos'];
        $email = $datos_k['correo'];
        $telefono = $datos_k['telefono'];
        $pass = $datos_k['contrasena'];
        $confirm_pass = $datos_k['v_contrasena'];
        
        $register = new RegisterContr($email, $nombre, $apellidos, $telefono, $pass, $confirm_pass);
        $error = $register->registerUser(); 
        $datos =0;
        
        switch ($error){
            case 0:{
                $mensaje = "Registrado";
                break;
            }
            case 1:{
                $mensaje = "Campo vacío";
                break;
            }
            case 2:{
                $mensaje = "Las contraseñas no coinciden";
                break;
            }
            case 3:{
                $mensaje = "Usuario ya existente";
                break;
            }
            case 4:{
                $mensaje = "Error en el incersión";
                break;
            }
            case 5:{
                $mensaje = "Error en la busqueda";
                break;
            }

        }

        $resp = [
            "error"=>$error,
            "mensaje"=>$mensaje,
            "datos"=>$datos
        ];

        header('Content-Type: application/json');


        echo json_encode($resp);
        

    }else{
        $resp = [
            "error"=> 6,
            "mensaje"=> "No accede",
            "datos"=> 0
        ];
        header('Content-Type: application/json');
        echo json_encode($resp);
    }

?>