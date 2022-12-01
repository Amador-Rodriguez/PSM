<?php
    include("producto.classes.php");

    class ProductoContr extends Producto{
        private $id_producto;
        private $id_usuario;
        private $cantidad;
        private $nombre;
        private $precio_venta;
        private $precio_compra;
        private $descripcion;
        private $expira;

        public function __construct() {
        }

        public function set($id_producto, $id_usuario, $cantidad, $nombre, $precio_venta, $precio_compra, $descripcion) {
            $this->id_producto = $id_producto;
            $this->id_usuario = $id_usuario;
            $this->cantidad = $cantidad;
            $this->nombre = $nombre;
            $this->precio_venta = $precio_venta;
            $this->precio_compra = $precio_compra;
            $this->descripcion = $descripcion;
            
        }

        public function GetAll($id_usuario){
            $data = $this->getTodo($id_usuario);
            return $data;
        }

        public function deleteProducto($id_producto, $id_usuario){
            $data = $this->borrarProducto($id_producto, $id_usuario);
            return $data;
        }

        public function addProducto(){
            $data = null;
            if(!$this->emptyInput()){
                $data = $this->insertProducto($this->id_producto, $this->id_usuario, $this->cantidad, $this->nombre, $this->precio_venta, $this->precio_compra, $this->descripcion);
            }else{
                $data = [
                    "error" => 1,
                    "mensaje" => "Campo vacío"
                ];
            }
            return $data;
        }

        public function actualizarProducto(){
            $data = null;
            if(!$this->emptyInput()){
                $data = $this->editarProducto($this->id_producto, $this->id_usuario, $this->cantidad, $this->nombre, $this->precio_venta, $this->precio_compra, $this->descripcion);
            }else{
                $data = [
                    "error" => 1,
                    "mensaje" => "Campo vacío"
                ];
            }
            return $data;
        }

        public function emptyInput(){
            $check = false;
            if( empty($this->id_producto) || empty($this->id_usuario) ||
                empty($this->cantidad) || empty($this->nombre) ||
                empty($this->precio_venta) || empty($this->precio_compra )||
                empty($this->descripcion))
                {
                    $check = true;
                }else{
                    $check = false;
                }
            return $check;
        }

    }


?>