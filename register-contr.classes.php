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
                return 1;
            }
            if($this->matchPwd()==false){
                return 2;
            }
            if($this->userCheck()==false){
                return 3;
            }
            $msg = $this->insertUser($this->nombre, $this->correo, $this->pwd);
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