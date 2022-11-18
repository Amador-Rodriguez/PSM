<?php
    include("dbh.classes.php");
    class Register extends Dbh{
        protected function insertUser($name, $email, $pwd){
            $stmt = $this->connect()->prepare('INSERT INTO usuario (nombre ,correo, pwd) VALUES (?,?,?);');
            $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
            if(!$stmt->execute(array($name, $email, $pwdHashed))){
                //echo "\nPDO::errorInfo():\n";
                //print_r($this->errorInfo());
                $stmt = null;
                //header("location: ../index.php?error=stmtfailedInsert");
                return 4;
                exit();
            }
            $stmt = null;

            $stmt = $this->connect()->prepare("SELECT * FROM usuario WHERE correo = ?;");
            $stmt->execute(array($email));
            $values=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt=null;
            $data=array();
            array_push($data, $values[0]["id_usuario"]);
            array_push($data, $values[0]["nombre"]);
            array_push($data, $values[0]["correo"]);
            array_push($data, 0);
            return $data;

            
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