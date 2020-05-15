<?php
	class NumeracionData{
		public static $tablename="numeracion";
		
		public function NumeracionData(){
			$this->numero_recibo = "";
			$this->fecha = "";
			$this->nombre_solicitante = "";
			$this->domicilio_solicitante = "";
			$this->ciudad_solicitante = "";
			$this->telefono_solicitante = "";
			$this->predial_obra = "";
			$this->ubicacion_obra = "";
			$this->colonia = "";
			$this->frente = "";
			$this->paramentos = "";
			$this->lindero_norte = "";
			$this->lindero_sur = "";
			$this->status = "";
			$this->lindero_oeste = "";
			$this->observaciones = "";
			$this->esquina = "";
			$this->lindero_este = "";
			$this->numero = "";
			$this->oficial = "";
		}
		//funcion agregar sin imagen
		public function add(){
			//$sql = "insert into ".self::$tablename." (numero_recibo,fecha,nombre_solicitante,domicilio_solicitante,ciudad_solicitante,telefono_solicitante,predial_obra,ubicacion_obra,frente,parametros,lindero_norte,lindero_sur,status,lindero_oeste,observaciones,esquina,lindero_este,numero,oficial) ";
			$sql = "insert into ".self::$tablename." (numero_recibo,fecha,nombre_solicitante,domicilio_solicitante,ciudad_solicitante,telefono_solicitante,predial_obra,ubicacion_obra,colonia,frente,paramentos,lindero_norte,lindero_sur,status,lindero_oeste,observaciones,esquina,lindero_este,numero,oficial) ";
			$sql .= "value (\"$this->numero_recibo\",\"$this->fecha\",\"$this->nombre_solicitante\",\"$this->domicilio_solicitante\",\"$this->ciudad_solicitante\",\"$this->telefono_solicitante\",\"$this->predial_obra\",\"$this->ubicacion_obra\",\"$this->colonia\",\"$this->frente\",\"$this->paramentos\",\"$this->lindero_norte\",\"$this->lindero_sur\",\"$this->status\",\"$this->lindero_oeste\",\"$this->observaciones\",\"$this->esquina\",\"$this->lindero_este\",\"$this->numero\",\"$this->oficial\")";
			return Executor::doit($sql);
		}
		public function update(){
			$sql = "update ".self::$tablename." set nombre_solicitante=\"$this->nombre_solicitante\",domicilio_solicitante=\"$this->domicilio_solicitante\",ciudad_solicitante=\"$this->ciudad_solicitante\",telefono_solicitante=\"$this->telefono_solicitante\",predial_obra=\"$this->predial_obra\",ubicacion_obra=$this->ubicacion_obra,colonia=$this->colonia,frente=\"$this->frente\",paramentos=\"$this->paramentos\",lindero_norte=\"$this->lindero_norte\",lindero_sur=\"$this->lindero_sur\",lindero_oeste=\"$this->lindero_oeste\",observaciones=\"$this->observaciones\",esquina=\"$this->esquina\",lindero_este=\"$this->lindero_este\",numero=\"$this->numero\",oficial=\"$this->oficial\" where numero_licencia=$this->numero_licencia";
			Executor::doit($sql);
		}
		
		public static function getById($numero_licencia){
		$sql = "select * from ".self::$tablename." where numero_licencia=$numero_licencia";
		$query = Executor::doit($sql);
		return Model::one($query[0],new NumeracionData());
	}
		
		//funcion para consultar los registros *Todos
		public static function getAll(){
			$sql = "select * from ".self::$tablename;
			$query = Executor::doit($sql);
			return Model::many($query[0],new NumeracionData());
		}
		
		//Consulta para obtener el ultimo id.
		public static function maxid(){
			$sql = "select numero_licencia from ".self::$tablename." order by numero_licencia desc limit 1";
			$query = Executor::doit($sql);
			return Model::one($query[0],new NumeracionData());
		}
		public static function getAllRecibo($numero_recibo){
			$sql ="select * from ".self::$tablename." where numero_recibo=$numero_recibo";
			$query = Executor::doit($sql);
			return Model::one($query[0],new NumeracionData());
		}
		public static function getAllByDateOp($start,$end){
			$sql = "select * from ".self::$tablename." where date(fecha) >= \"$start\" and date(fecha) <= \"$end\" order by fecha ASC";
			$query = Executor::doit($sql);
			return Model::many($query[0],new NumeracionData());
		}
		
		
	}
?>