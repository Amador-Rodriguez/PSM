<?php
    include("dbh.classes.php");
    class Login extends Dbh{

        protected function logUser($email, $pwd){
            $stmt = $this->connect()->prepare('SELECT * FROM usuario WHERE correo = ?');
            
            if(!$stmt->execute(array($email))){
                $stmt = null;
                //echo("stmtfailedLogin");
                return "ErrorStmt";
                exit();
            }

            $check;
            if($stmt->rowCount() == 0){
                $stmt = null;
                //echo("userNotFound");
                return "UserNotFound";
                exit();

            }
            

            $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $checkPwd = password_verify($pwd,$values[0]["pwd"]);
            if($checkPwd==false){
                $stmt= null;
               // echo("WrongPassword");
                return "WrongPassword";
                
                exit();
            }
            
            return "NoErrors";

            $stmt = null;
        }
        
    }
?>