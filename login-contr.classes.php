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
            
            
            $this->logUser($this->correo, $this->pwd);
        }


        
       
    }
?>