<?php
    include("dbh.classes.php");
    class Login extends Dbh{

        protected function logUser($email, $pwd){
            $stmt = $this->connect()->prepare('SELECT * FROM usuario WHERE correo = ?');
            
            if(!$stmt->execute(array($email))){
                $stmt = null;
                //echo("stmtfailedLogin");
                return 1;
                exit();
            }

            $check;
            if($stmt->rowCount() == 0){
                $stmt = null;
                //echo("userNotFound");
                return 2;
                exit();

            }
            

            $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $checkPwd = password_verify($pwd,$values[0]["pwd"]);
            if($values[0]["pwd"]!=$pwd){
                $stmt= null;
               // echo("WrongPassword");
                return 3;
                
                exit();
            }
            

            $stmt = null;
            return 0;

            
        }
        
    }
?>