<?php
 include("transaction-contr.classes.php");
     if($_SERVER["REQUEST_METHOD"] == "POST"){

        $datos_k = json_decode(file_get_contents('php://input'), true);


        $idTransaccion = $datos_k['idTransaccion'];
        $codigoProducto = $datos_k['codigoProducto'];
        $idUsuario = $datos_k['idUsuario'];
        $isEntrada = $datos_k['isEntrada'];
        $cantidad = $datos_k['cantidad'];
        $observaciones = $datos_k['observaciones'];
        $fecha = $datos_k['fecha'];
        
        
        
        $transaccion = new TransactionContr();
        $transaccion->set($idTransaccion, $codigoProducto, $idUsuario, $isEntrada, $cantidad, $observaciones, $fecha);
        $data = $transaccion->addTransaccion();

        header('Content-Type: application/json');
        echo json_encode($data);

    }else if($_SERVER["REQUEST_METHOD"] == "PATCH"){
        
        $datos_k = json_decode(file_get_contents('php://input'), true);
        $id_producto = $datos_k['id_producto'];
        $id_usuario = $datos_k['id_usuario'];

        $producto = new TransactionContr();
        $data = $producto->deleteProducto($id_producto, $id_usuario);
        
        header('Content-Type: application/json');
        echo json_encode($data);

    }else{
        echo "error";
    }

?>