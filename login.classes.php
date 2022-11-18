<?php include("dbh.classes.php");

class Login extends Dbh {

    protected function logUser($email, $pwd) {
        $stmt=$this->connect()->prepare('SELECT * FROM usuario WHERE correo = ?');
        $data=array();


        if( !$stmt->execute(array($email))) {
            $stmt=null;
            //echo("stmtfailedLogin");
            array_push($data, null);
            array_push($data, null);
            array_push($data, null);
            array_push($data, 1);
            return $data;
            exit();
        }

        $check;

        if($stmt->rowCount()==0) {
            $stmt=null;
            //echo("userNotFound");
            array_push($data, null);
            array_push($data,null);
            array_push($data, null);
            array_push($data, 2);
            return $data;
            exit();

        }

        $values=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd=password_verify($pwd, $values[0]["pwd"]);

        if(!$checkPwd) {
            $stmt=null;
            // echo("WrongPassword");
            array_push($data, null );
            array_push($data, null);
            array_push($data, null);
            array_push($data, 3);
            return $data;

            exit();
        }

        $stmt=null;
        array_push($data, $values[0]["id_usuario"]);
        array_push($data, $values[0]["nombre"]);
        array_push($data, $values[0]["correo"]);
        array_push($data, 0);
        return $data;


    }

}

?>