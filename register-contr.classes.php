<?php
    include("register.classes.php");

    class RegisterContr extends Register{
        private $correo;    
        private $nombre;
        private $pwd;
        private $confirm;

       

        public function __construct($correo, $nombre, $pwd, $confirm) {
            $this->correo = $correo;
            $this->nombre = $nombre;
            $this->pwd = $pwd;
            $this->confirm = $confirm;
           
        }

        public function registerUser(){
            if($this->emptyInput()==false){
                $data=array();
                array_push($data, null);
                array_push($data, null);
                array_push($data, null);
                array_push($data, 1);
                return $data;
            }
            if($this->matchPwd()==false){
                $data=array();
                array_push($data, null);
                array_push($data, null);
                array_push($data, null);
                array_push($data, 2);
                return $data;
            }
            if($this->userCheck()==false){
                $data=array();
                array_push($data, null);
                array_push($data, null);
                array_push($data, null);
                array_push($data, 3);
                return $data;
            }
            $data = $this->insertUser($this->nombre, $this->correo, $this->pwd);
            return $data;
        }

        private function matchPwd(){
            $check; 
            if($this->pwd != $this->confirm){
                $check = false;
            }
            else{
                $check = true;
            }
            return $check;
        }

        private function userCheck(){
            $check;
            if(!$this->checkUser($this->correo)){
                $check = false;
            }
            else{
                $check = true;
            }
            return $check;
        }

        

        private function emptyInput(){
            $check;
            if(empty($this->pwd) || empty($this->confirm) || empty($this->nombre) || empty($this->correo)){
                $check = false;
            }
            else{
                $check = true;
            }
            return $check;
        }
       
    }
?>