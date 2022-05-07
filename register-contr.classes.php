<?php
    include("register.classes.php");

    class RegisterContr extends Register{
        private $correo;    
        private $nombre;
        private $telefono;
        private $pwd;
        private $confirm;
        private $apellidos;
       

        public function __construct($correo, $nombre, $apellidos,$telefono, $pwd, $confirm) {
            $this->correo = $correo;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->telefono = $telefono;
            $this->pwd = $pwd;
            $this->confirm = $confirm;
           
        }

        public function registerUser(){
            if($this->emptyInput()==false){
                return 1;
            }
            if($this->matchPwd()==false){
                return 2;
            }
            if($this->userCheck()==false){
                return 3;
            }
            $msg = $this->insertUser($this->nombre,$this->apellidos, $this->correo, $this->telefono, $this->pwd);
            return $msg;
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
            if(empty($this->pwd) || empty($this->confirm) || empty($this->apellidos) ||empty($this->nombre) || empty($this->correo) || empty($this->telefono)){
                $check = false;
            }
            else{
                $check = true;
            }
            return $check;
        }
       
    }
?>