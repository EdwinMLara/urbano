<?php
    require_once('constants.php');
    class Rest{
        protected $request;
        protected $serviceName;
        protected $param;

        public function __construct(){
            if($_SERVER['REQUEST_METHOD'] !== 'POST'){
                $this->throwError(REQUEST_METHOD_NOT_VALID,"Request method is not valid");
            }
            $handler = fopen('php://input','r');
            $this->request = stream_get_contents($handler);
            $this->validateRequest();
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

    }
?>