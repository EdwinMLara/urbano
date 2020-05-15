<?php
	class OldDataBase{
		public static $tablenamenu="oldbno";
		public static $tablenamecon="oldcon";
		
		public function OldDataBase(){
			$this->numero_licencia = "";
			$this->numero_recibo = "";
			$this->fecha = "";
			$this->nombre_solicitante = "";
			$this->domicilio_solicitante = "";
			$this->ciudad_solicitante = "";
			$this->telefono_solicitante = "";
			$this->predial_obra = "";
			$this->ubicacion_obra = "";
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
		
		//funcion para consultar los registros *Todos
		public static function getAllnu(){
			$sql = "select * from ".self::$tablenamenu.' ORDER BY numero_licencia DESC';
			$query = Executor::doit($sql);
			return Model::many($query[0],new OldDataBase());
		}
		public static function getById($numero_licencia){
			$sql = "select * from ".self::$tablenamenu." where numero_licencia=$numero_licencia";
			$query = Executor::doit($sql);
			return Model::one($query[0],new OldDataBase());
		}
		
		public function update(){
			$sql = "update ".self::$tablenamenu." set nombre_solicitante=\"$this->nombre_solicitante\",domicilio_solicitante=\"$this->domicilio_solicitante\",ciudad_solicitante=\"$this->ciudad_solicitante\",telefono_solicitante=\"$this->telefono_solicitante\",predial_obra=\"$this->predial_obra\",ubicacion_obra=\"$this->ubicacion_obra\",frente=\"$this->frente\",paramentos=\"$this->paramentos\",lindero_norte=\"$this->lindero_norte\",lindero_sur=\"$this->lindero_sur\",lindero_oeste=\"$this->lindero_oeste\",observaciones=\"$this->observaciones\",esquina=\"$this->esquina\",lindero_este=\"$this->lindero_este\",numero=\"$this->numero\",oficial=\"$this->oficial\" where numero_licencia=$this->numero_licencia";
			Executor::doit($sql);
		}
		
		//Funcion de optener las licencias de construccion
		
		public static function getAllcon(){
			$sql = "select * from ".self::$tablenamecon.' ORDER BY numero_licencia DESC';
			$query = Executor::doit($sql);
			return Model::many($query[0],new OldDataBase());
		}
		
		public static function getAllRecibo($id){
			$sql ="select * from ".self::$tablenamenu." where id=$id";
			$query = Executor::doit($sql);
			return Model::one($query[0],new OldDataBase());
		}
	}
?>