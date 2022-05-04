<?php
    include("../classes/register.classes.php");

    class RegisterContr extends Register{
        private $correo;    
        private $nombre;
        private $telefono;
        private $pwd;
        private $confirm;
        private $like_reportero;

        public function __construct($correo, $nombre, $telefono, $pwd, $confirm, $like_reportero) {
            $this->correo = $correo;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->pwd = $pwd;
            $this->confirm = $confirm;
            $this->like_reportero = $like_reportero;
        }

        public function registerUser(){
            if($this->emptyInput()==false){
                header("location: ../login.php?error=emptyInput");
                exit();
            }
            if($this->matchPwd()==false){
                header("location: ../login.php?error=matchPwd");
                exit();
            }
            

            if($this->like_reportero==0){
                if($this->userCheck()==false){
                    header("location: ../login.php?error=userCheck");
                    exit();
                }
                $this->insertUser($this->nombre, $this->correo, $this->telefono, $this->pwd);
            }else{
                if($this->reporteroCheck()==false){
                    header("location: ../login.php?error=userCheck");
                    exit();
                }
                $this->insertReportero($this->nombre, $this->correo, $this->telefono, $this->pwd);
            }
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

        private function reporteroCheck(){
            $check;
            if(!$this->checkReportero($this->correo)){
                $check = false;
            }
            else{
                $check = true;
            }
            return $check;
        }

        private function emptyInput(){
            $check;
            if(empty($this->pwd) || empty($this->confirm) ||empty($this->nombre) || empty($this->correo) || empty($this->telefono)){
                $check = false;
            }
            else{
                $check = true;
            }
            return $check;
        }
       
    }
?>