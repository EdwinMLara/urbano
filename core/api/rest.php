<?php
    require_once('constants.php');
    class Rest{
        protected $request;
        protected $serviceName;
        protected $param;
        protected $username;

        public function __construct(){
            if($_SERVER['REQUEST_METHOD'] !== 'POST'){
                $this->throwError(REQUEST_METHOD_NOT_VALID,"Request method is not valid");
            }
            $handler = fopen('php://input','r');
            $this->request = stream_get_contents($handler);
            $this->validateRequest();

            if('generateToken' != $this->serviceName){
                $this->validateToken();
            }                        
        }

        public function validateRequest(){
            if($_SERVER['CONTENT_TYPE'] !== 'application/json'){
                $this->throwError(REQUEST_CONTENTTYPE_NOT_VALID,"Request content type is no valid");
            }

            $data = json_decode($this->request, true);
            
            if(!isset($data["name"]) || $data["name"] == ""){
                $this->throwError(API_NAME_REQUIRED,"Api name is requiered");
            }
            $this->serviceName = $data["name"];

            if(!is_array($data["param"])){
                $this->throwError(API_PARAM_REQUIRED,'Api Param is required');
            }

            $this->param = $data["param"];
        }

        public function processApi(){
            $api = new API;
            $rMethod = new ReflectionMethod('API',$this->serviceName);
            if(!method_exists($api,$this->serviceName)){
                $this->throwError(API_DOST_NOT_EXIST,"Api does not exist.");
            }

            $rMethod->invoke($api);  
        }

        public function validateParameter($fieldName,$value,$dataType,$required = true){
            if($required && empty($value) == true){
                $this->throwError(VALIDATE_PARAMETER_REQUIRED,$fieldName." parameter is requiered");
            }

            switch($dataType){
                case BOOLEAN:
                    if(!is_bool($value)){
                        $this->throwError(VALIDATE_PARAMETER_DATATYPE,"Datatype is no a valid for".$fieldName." it should be boolean");
                    }
                    break;
                case INTEGER:
                    if(!is_numeric($value)){
                        $this->throwError(VALIDATE_PARAMETER_DATATYPE,"Datatype is no a valid for ".$fieldName." it should be numeric");
                    }
                    break;
                case STRING:
                    if(!is_string($value)){
                        $this->throwError(VALIDATE_PARAMETER_DATATYPE,"Datatype is no a valid for ".$fieldName." it should be a string");
                    }
                    break;
                default:
                    $this->throwError(VALIDATE_PARAMETER_DATATYPE,"DataType is no valid for".$fieldName);
                    break;
            }

            return $value;
        }

        public function throwError($code,$message){
            header("content-type: application/json");
            $errorMsj = json_encode(['error'=> ['status'=>$code,'message'=>$message]]);
            echo $errorMsj;
            exit;
        }

        public function returnResponse($code,$data){
            header("content-type: application/json");
            $response = json_encode(['response' => ['status' => $code,'result' => $data]]);
            echo $response;
            exit; 
        }

        public function getAuthorizationHeader(){
            $headers = null;
            if(isset($_SERVER['Authorization'])){
                $headers = trim($_SERVER['Authorization']);
            }else if(isset($_SERVER['HTTP_AUTHORIZATION'])){
                $headers = trim($_SERVER['HTTP_AUTHORIZATION']);
            }else if(function_exists('apache_request_headers')){
                $requestHeaders = apache_request_headers();
                $requestHeaders = array_combine(array_map('ucwords',array_keys($requestHeaders)),array_values($requestHeaders));
                if(isset($requestHeaders['Authorization'])){
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
            return $headers;

        }

        public function getBearerToken(){
            $headers = $this->getAuthorizationHeader();

            if(!empty($headers)){
                if(preg_match('/Bearer\s(\S+)/',$headers,$matches)){
                    return $matches[1];
                }
            }

            $this->throwError(ATHORIZATION_HEADER_NOT_FOUND,"Access Token not found");
        }

        public function validateToken(){
            try{
                $token = $this->getBearerToken();
                $payload = JWT::decode($token,SECRET_KEY,['HS256']);
                if(!is_object($payload)){
                    $this->throwError(VALIDATE_PARAMETER_DATATYPE,"The Datatype in the token is invalid.");
                }

                $this->username = $payload->username;
            }catch(Exception $e){
                $this->throwError(ACCESS_TOKEN_ERROS,$e->getMessage());
            }

        }
    }
?>