<?php
    include_once '../autoload.php';
    include_once '../app/model/UserData.php';
    include_once '../app/model/ConstruccionData.php';
    include_once './construcion-api.php';
    include_once './rest.php';
    include_once './jwt.php';

    class Api extends Rest{
        public function __construct(){
            parent::__construct();  
        }

        public function generateToken(){
            $email = $this->validateParameter('username',$this->param["username"],STRING);
            $pass = $this->validateParameter('password',$this->param["password"],STRING);
            $pass = Sha1(md5($pass));
            try{
                $user = UserData::getByMail($email);
                
                if(!is_object($user)){
                    $this->returnResponse(INVALID_USER_PASS,"The email is incorrect. ");
                }

                if($user->is_active == 0){
                    $this->returnResponse(USER_NOT_ACTIVE,"The user not active.");
                }

                if(!($pass == $user->password)){
                    $this->returnResponse(INVALID_USER_PASS,"The password is incorrect.");
                }

                $payload = [
                    'iat' => time(),
                    'iss' => 'localhost',
                    'exp' => time()+(20*60), //son segundo para que no se olvide
                    'userId' => $user->id
                ];

                $token = JWT::encode($payload,SECRET_KEY);
                $data = ['token' => $token];
                $this->returnResponse(SUCESS_RESPONSE,$data);
            }catch(Exception $e){
                $this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
            }
        }

        public function contructionData(){
            $licencia = new ConstruccionData();
            $key = pack('H*','aaaaaaaaaaaaa');
            $method = 'aes-256-ecb';
            $value = $this->validateParameter('value',$this->param["numero_recibo"],STRING);
            $decrypted = decrypt($value, $key, $method);
            $this->returnResponse(SUCESS_RESPONSE,$licencia->get_json($decrypted));
        }
    }

    
?>