<?php
    include("dbh.classes.php");
    class Register extends Dbh{
        protected function insertUser($name,$apellidos, $email, $phone, $pwd){
            $stmt = $this->connect()->prepare('INSERT INTO usuario (nombre, apellidos ,correo, telefono, pwd) VALUES (?,?,?,?,?);');
            $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
            if(!$stmt->execute(array($name,$apellidos, $email, $phone, $pwdHashed))){
                //echo "\nPDO::errorInfo():\n";
                //print_r($this->errorInfo());
                $stmt = null;
                //header("location: ../index.php?error=stmtfailedInsert");
                return 4;
                exit();
            }
            $stmt = null;
            return 0;
        }

        protected function checkUser($email){
            $stmt = $this->connect()->prepare("SELECT correo FROM usuario WHERE correo = ?;");
            if(!$stmt->execute(array($email))){
                $stmt = null;
                //header("location: ../index.php?error=stmtfailedCheck");
                
                exit();
            }
            $check;
            if($stmt->rowCount()>0){
                $check = false;
            }
            else{
                $check = true;
            }
            
            return $check;
        }

       
        

    }
?>