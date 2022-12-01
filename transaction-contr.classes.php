<?php
    include("transaction.classes.php");

    class TransactionContr extends Transaction{
        private $idTransaccion;
        private $codigoProducto;
        private $idUsuario;
        private $isEntrada;
        private $cantidad;
        private $observaciones;
        private $fecha;

        public function __construct() {
        }

        public function set($idTransaccion, $codigoProducto, $idUsuario, $isEntrada, $cantidad, $observaciones, $fecha) {
            $this->idTransaccion = $idTransaccion;
            $this->codigoProducto = $codigoProducto;
            $this->idUsuario = $idUsuario;
            $this->isEntrada = $isEntrada;
            $this->cantidad = $cantidad;
            $this->observaciones = $observaciones;
            $this->fecha = $fecha;
            
        }

        public function GetAll($id_usuario){
            $data = $this->getTodo($id_usuario);
            return $data;
        }

        public function deleteProducto($id_producto, $id_usuario){
            $data = $this->borrarProducto($id_producto, $id_usuario);
            return $data;
        }

        public function addTransaccion(){
            $data = null;
            if(!$this->emptyInput()){
                $data = $this->insertTransaccion($this->idTransaccion, $this->codigoProducto, $this->idUsuario, $this->isEntrada, $this->cantidad, $this->observaciones, $this->fecha);
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
            if( empty($this->idTransaccion) || empty($this->codigoProducto) ||
                empty($this->idUsuario) ||
                empty($this->cantidad) || empty($this->observaciones )||
                empty($this->fecha))
                {
                    $check = true;
                }else{
                    $check = false;
                }
            return $check;
        }

    }


?>