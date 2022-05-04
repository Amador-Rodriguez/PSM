<?php
 include("../classes/register-contr.classes.php");

    if(isset($_POST['submit'])){
        $email = $_POST['correo'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $pass = $_POST['contrasena'];
        $confirm_pass = $_POST['v_contrasena'];
        $like_reportero;
        $value = $_POST["chkbx_editor"];
        
        echo $value;

        //$register = new RegisterContr($email, $nombre, $telefono, $pass, $confirm_pass, $like_reportero);
        //$register->registerUser(); 
        //header("location: ../login.php?error=none");

    }else{
        echo "error";
    }

?>