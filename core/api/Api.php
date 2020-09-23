<?php
    include_once '../autoload.php';
    include_once '../app/model/UserData.php';
    include_once '../app/model/ConstruccionData.php';

    class Api extends Rest{
        public function __construct(){
            parent::__construct();  
            if('generateToken' == $this->serviceName){
                $this->generateToken();
            }else{
                $this->processApi();
            }
        }

        public function generateToken(){
            $email = $this->validateParameter('email',$this->param["email"],STRING);
            $pass = $this->validateParameter('pass',$this->param["pass"],STRING);
            try{
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
                    'exp' => time()+(5*60), //son segundo para que no se olvide
                    'userId' => $user->username
                ];

                $token = JWT::encode($payload,SECRET_KEY);
                $data = ['token' => $token];
                $this->returnResponse(SUCESS_RESPONSE,$data);
            }catch(Exception $e){
                $this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
            }
        }

        public function constructionData(){
            echo "Aqui va la api para obtenener los datos de construccion";
        }
    }

    
?>