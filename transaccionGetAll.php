<?php
 include("transaction-contr.classes.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos_k = json_decode(file_get_contents('php://input'), true);

        $id_usuario = $datos_k[0]['idUsuario'];

        $transaccion = new TransactionContr();
        $data = $transaccion->GetAll($id_usuario);

        header('Content-Type: application/json');
        echo json_encode($data);

    }else{
        echo "error";
    }

?>