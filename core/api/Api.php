<?php
    include_once '../autoload.php';
    include_once '../app/model/UserData.php';

    class Api extends Rest{
        public function __construct(){
            parent::__construct();
            $this->generateToken();    
        }

        public function generateToken(){
            $email = $this->validateParameter('email',$this->param["email"],STRING);
            $pass = $this->validateParameter('pass',$this->param["pass"],STRING);

            $user = UserData::getByMail($email);
            
            if(!is_object($user)){
                $this->returnResponse(INVALID_USER_PASS,"email or password is incorrect. ");
            }

            if($user->is_active == 0){
                $this->returnResponse(USER_NOT_ACTIVE,"The user not active.");
            }

            $payload = [
                'iat' => time(),
                'iss' => 'localhost',
                'exp' => time()+(60),
                'userId' => $user->username
            ];

            $token = JWT::encode($payload,SECRET_KEY);
            $data = ['token' => $token];
            $this->returnResponse(SUCESS_RESPONSE,$data);
        }
    }

    
?>