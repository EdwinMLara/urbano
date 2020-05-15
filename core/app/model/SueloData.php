<?php
	class SueloData{
		public static $tablename="usosuelo";
		
		public function SueloData(){
			$this->numero_recibo = "";
			$this->nombre_solicitante = "";
			$this->domicilio_solicitante = "";
			$this->numero = "";
			$this->colonia = "";
			$this->fecha_alta = "";
			$this->status = "";
			$this->fecha_sol = "";
			$this->domicilio_predio = "";
			$this->numero_predio = "";
			$this->colonia_predio = "";
		}
		//funcion agregar sin imagen
		public function add(){
			$sql = "insert into ".self::$tablename." (numero_recibo,nombre_solicitante,domicilio_solicitante,numero,colonia,fecha_alta,status,fecha_sol,domicilio_predio,numero_predio,colonia_predio) ";
			$sql .= "value (\"$this->numero_recibo\",\"$this->nombre_solicitante\",\"$this->domicilio_solicitante\",\"$this->numero\",\"$this->colonia\",\"$this->fecha_alta\",\"$this->status\",\"$this->fecha_sol\",\"$this->domicilio_predio\",\"$this->numero_predio\",\"$this->colonia_predio\")";
			return Executor::doit($sql);
		}
		
		//funcion para consultar los registros *Todos
		public static function getAll(){
			$sql = "select * from ".self::$tablename;
			$query = Executor::doit($sql);
			return Model::many($query[0],new SueloData());
		}
		//Consulta para obtener el ultimo id.
		public static function maxid(){
			$sql = "SELECT id FROM ".self::$tablename." ORDER BY id DESC LIMIT 1";
			$query = Executor::doit($sql);
			return Model::one($query[0],new SueloData());
		}
		public static function getAllNombre($nombre){
			$sql ="select * from ".self::$tablename." where nombre=$nombre";
			$query = Executor::doit($sql);
			return Model::one($query[0],new SueloData());
		}
		public static function getAllRecibo($numero_recibo){
			$sql ="select * from ".self::$tablename." where numero_recibo=$numero_recibo";
			$query = Executor::doit($sql);
			return Model::one($query[0],new SueloData());
		}
		public static function getAllByDateOp($start,$end){
			$sql = "select * from ".self::$tablename." where date(fecha_alta) >= \"$start\" and date(fecha_alta) <= \"$end\" order by fecha_alta ASC";
			$query = Executor::doit($sql);
			return Model::many($query[0],new SueloData());
		}
	}
?>