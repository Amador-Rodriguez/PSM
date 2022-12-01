<?php
    include("dbh.classes.php");
    class Transaction extends Dbh{

        protected function insertTransaccion($idTransaccion, $codigoProducto, $idUsuario, $isEntrada, $cantidad, $observaciones, $fecha){
            

            
            $stmt = $this->connect()->prepare('INSERT INTO Transaccion (idTransaccion, codigoProducto, idUsuario, isEntrada, cantidad, observaciones, fecha) VALUES (?,?,?,?,?,?,?);');
        
        
            if(!$stmt->execute(array($idTransaccion, $codigoProducto, $idUsuario, $isEntrada, $cantidad, $observaciones, $fecha))){
                //echo "\nPDO::errorInfo():\n";
                //print_r($this->errorInfo());
                $stmt = null;
                //header("location: ../index.php?error=stmtfailedInsert");

                $data = [
                    "error" => 1,
                    "mensaje" => "Error en la inserción"
                ];

                return $data;
                exit();
            }
            $stmt = null;

            $stmt = $this->connect()->prepare("SELECT * FROM Transaccion WHERE idTransaccion = ? AND idUsuario = ?;");
            $stmt->execute(array($idTransaccion, $idUsuario));
            $values=$stmt->fetchAll(PDO::FETCH_ASSOC);

            $data = [
                "error" => 0,
                "mensaje" => "Insertado correctamente",
                "idTransaccion"=> $values[0]["idTransaccion"],
                "codigoProducto"=> $values[0]["codigoProducto"],
                "idUsuario"=>$values[0]["idUsuario"],
                "isEntrada"=> $values[0]["isEntrada"],
                "cantidad"=> $values[0]["cantidad"],
                "observaciones"=> $values[0]["observaciones"],
                "fecha"=> $values[0]["fecha"],
                
            ];

            
            return $data;

        }

        

        protected function getTodo($id_usuario){
            $stmt = $this->connect()->prepare("SELECT * FROM Transaccion WHERE idUsuario = ?;");
            $stmt->execute(array($id_usuario));
            $values=$stmt->fetchAll(PDO::FETCH_ASSOC);

            $data = array();

            for( $i = 0; $i < sizeof($values); $i++){
                array_push($data, $values[$i]);
            }
            
            return $data;
        }

        protected  function borrarProducto($id_producto, $id_usuario ){


            $stmt = $this->connect()->prepare("SELECT * FROM Producto WHERE id_producto = ? AND id_usuario = ?;");
            $stmt->execute(array($id_producto, $id_usuario));
            if($stmt->rowCount()==0){
                $data = [
                    "error" => 1,
                    "mensaje" => "Producto no encontrado"
                ];

                return $data;
                exit();
            }else{
                $values=$stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt = null;
    
                $stmt = $this->connect()->prepare('DELETE FROM Producto WHERE id_producto = ? AND id_usuario = ?;');
            
                if(!$stmt->execute(array($id_producto, $id_usuario))){
                    //echo "\nPDO::errorInfo():\n";
                    //print_r($this->errorInfo());
                    $stmt = null;
                    //header("location: ../index.php?error=stmtfailedInsert");
    
                    $data = [
                        "error" => 1,
                        "mensaje" => "Error al borrar"
                    ];
    
                    return $data;
                    exit();
                }
                
    
    
                $data = [
                    "error" => 0,
                    "mensaje" => "Borrado correctamente",
                    "id_producto"=> $values[0]["id_producto"],
                    "id_usuario"=> $values[0]["id_usuario"],
                    "cantidad"=>$values[0]["cantidad"],
                    "nombre"=> $values[0]["nombre"],
                    "precio_venta"=> $values[0]["precio_venta"],
                    "precio_compra"=> $values[0]["precio_compra"],
                    "descripcion"=> $values[0]["descripcion"],
                    
                ];
    
                
                return $data;
            }
            
        }


    }
?>