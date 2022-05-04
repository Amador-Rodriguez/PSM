<?php
    include("login.classes.php");

    class LoginContr extends Login{
        private $correo;    
        
        private $pwd;
      

        public function __construct($correo, $pwd) {
            $this->correo = $correo;
            
            $this->pwd = $pwd;
            
        }

        public function loginUser(){
            
            
            $msg = $this->logUser($this->correo, $this->pwd);
            return $msg;
        }


        
       
    }
?>