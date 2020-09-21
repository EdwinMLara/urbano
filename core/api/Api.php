<?php
    class Api extends Rest{
        public function __construct(){
            parent::__construct();
            $this->generateToken();    
        }

        public function generateToken(){
            $email = $this->validateParameter('email',$this->param["email"],STRING);
            echo $email;
        }
    }

    
?>