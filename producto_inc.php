<?php
 include("producto-contr.classes.php");
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $datos_k = json_decode(file_get_contents('php://input'), true);

        $id_usuario = $datos_k['id_usuario'];

        $producto = new ProductoContr();
        $data = $producto->GetAll($id_usuario);

        header('Content-Type: application/json');
        echo json_encode($data);

    }else if($_SERVER["REQUEST_METHOD"] == "POST"){

        $datos_k = json_decode(file_get_contents('php://input'), true);


        $id_producto = $datos_k['id_producto'];
        $id_usuario = $datos_k['id_usuario'];
        $cantidad = $datos_k['cantidad'];
        $nombre = $datos_k['nombre'];
        $precio_venta = $datos_k['precio_venta'];
        $precio_compra = $datos_k['precio_compra'];
        $descripcion = $datos_k['descripcion'];
        
        
        
        $producto = new ProductoContr();
        $producto->set($id_producto, $id_usuario, $cantidad, $nombre, $precio_venta, $precio_compra, $descripcion);
        $data = $producto->addProducto();

        header('Content-Type: application/json');
        echo json_encode($data);

    }else if($_SERVER["REQUEST_METHOD"] == "PUT"){
        $datos_k = json_decode(file_get_contents('php://input'), true);


        $id_producto = $datos_k['id_producto'];
        $id_usuario = $datos_k['id_usuario'];
        $cantidad = $datos_k['cantidad'];
        $nombre = $datos_k['nombre'];
        $precio_venta = $datos_k['precio_venta'];
        $precio_compra = $datos_k['precio_compra'];
        $descripcion = $datos_k['descripcion'];
        
        
        $producto = new ProductoContr();
        $producto->set($id_producto, $id_usuario, $cantidad, $nombre, $precio_venta, $precio_compra, $descripcion);
        $data = $producto->actualizarProducto();

        header('Content-Type: application/json');
        echo json_encode($data);

    }else if($_SERVER["REQUEST_METHOD"] == "PATCH"){
        
        $datos_k = json_decode(file_get_contents('php://input'), true);
        $id_producto = $datos_k['id_producto'];
        $id_usuario = $datos_k['id_usuario'];

        $producto = new ProductoContr();
        $data = $producto->deleteProducto($id_producto, $id_usuario);
        
        header('Content-Type: application/json');
        echo json_encode($data);

    }else{
        echo "error";
    }

?>