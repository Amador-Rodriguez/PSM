<?php
 include("producto-contr.classes.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos_k = json_decode(file_get_contents('php://input'), true);

        $id_usuario = $datos_k[0]['id_usuario'];

        $producto = new ProductoContr();
        $data = $producto->GetAll($id_usuario);

        header('Content-Type: application/json');
        echo json_encode($data);

    }else{
        echo "error";
    }

?>