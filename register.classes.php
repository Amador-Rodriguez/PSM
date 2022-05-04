<?php
    include("../classes/dbh.classes.php");
    class Register extends Dbh{
        protected function insertUser($name, $email, $phone, $pwd){
            $stmt = $this->connect()->prepare('INSERT INTO USERS (Nombre, correo, telefono, contraseña) VALUES (?,?,?,?);');
            $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
            if(!$stmt->execute(array($name, $email, $phone, $pwdHashed))){
                //echo "\nPDO::errorInfo():\n";
                //print_r($this->errorInfo());
                $stmt = null;
                header("location: ../index.php?error=stmtfailedInsert");
                exit();
            }
            $stmt = null;
        }

        protected function insertReportero($name, $email, $phone, $pwd){
            $stmt = $this->connect()->prepare('INSERT INTO Reportero (Nombre, Correo, Telefono, Clave, FirmaAutor, activo) VALUES (?,?,?,?,?,?);');
            $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
            if(!$stmt->execute(array($name, $email, $phone, $pwdHashed))){
                //echo "\nPDO::errorInfo():\n";
                //print_r($this->errorInfo());
                $stmt = null;
                header("location: ../index.php?error=stmtfailedInsert");
                exit();
            }
            $stmt = null;
        }

        protected function checkUser($email){
            $stmt = $this->connect()->prepare("SELECT correo FROM USERS WHERE correo = ?;");
            if(!$stmt->execute(array($email))){
                $stmt = null;
                header("location: ../index.php?error=stmtfailedCheck");
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

        protected function checkReportero($email){
            $stmt = $this->connect()->prepare("SELECT correo FROM Reportero WHERE correo = ?;");
            if(!$stmt->execute(array($email))){
                $stmt = null;
                header("location: ../index.php?error=stmtfailedCheck");
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