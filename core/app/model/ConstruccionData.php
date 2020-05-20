<?php
	class ConstruccionData{
		public static $tablename="licenciacons";
		
		public function ConstruccionData(){
			$this->numero_recibo = "";
			$this->vigencia1 = "";
			$this->vigencia2 = "";
			$this->nombre_solicitante = "";
			$this->domicilio_solicitante = "";
			$this->ciudad_solicitante = "";
			$this->telefono_solicitante = "";
			$this->predial_obra = "";
			$this->ubicacion_obra = "";
			$this->destino_obra = "";
			$this->superficie_obra = "";
			$this->documentos_obra = "";
			$this->fecha = "";
			$this->status = "";
			$this->nombre_suscriptor = "";
			$this->numero_perito = "";
			$this->domicilio_suscriptor = "";
			$this->observaciones = "";
		}
		//funcion agregar sin imagen
		public function add(){
			$sql = "insert into ".self::$tablename." (numero_recibo,vigencia1,vigencia2,nombre_solicitante,domicilio_solicitante,ciudad_solicitante,telefono_solicitante,predial_obra,ubicacion_obra,destino_obra,superficie_obra,documentos_obra,fecha,status,nombre_suscriptor,numero_perito,domicilio_suscriptor,observaciones,pdf) ";
			$sql .= "value (\"$this->numero_recibo\",\"$this->vigencia1\",\"$this->vigencia2\",\"$this->nombre_solicitante\",\"$this->domicilio_solicitante\",\"$this->ciudad_solicitante\",\"$this->telefono_solicitante\",\"$this->predial_obra\",\"$this->ubicacion_obra\",\"$this->destino_obra\",\"$this->superficie_obra\",\"$this->documentos_obra\",\"$this->fecha\",\"$this->status\",\"$this->nombre_suscriptor\",\"$this->numero_perito\",\"$this->domicilio_suscriptor\",\"$this->observaciones\",\"$this->pdf\")";
			return Executor::doit($sql);
		}
		//funcion agregar con imagen
		public function add_with_image(){
			$sql = "insert into ".self::$tablename." (numero_recibo,vigencia1,vigencia2,nombre_solicitante,domicilio_solicitante,ciudad_solicitante,telefono_solicitante,predial_obra,ubicacion_obra,destino_obra,superficie_obra,documentos_obra,fecha,status,image,nombre_suscriptor,numero_perito,domicilio_suscriptor,observaciones,pdf) ";
			$sql .= "value (\"$this->numero_recibo\",\"$this->vigencia1\",\"$this->vigencia2\",\"$this->nombre_solicitante\",\"$this->domicilio_solicitante\",\"$this->ciudad_solicitante\",\"$this->telefono_solicitante\",\"$this->predial_obra\",\"$this->ubicacion_obra\",\"$this->destino_obra\",\"$this->superficie_obra\",\"$this->documentos_obra\",\"$this->fecha\",\"$this->status\",\"$this->image\",\"$this->nombre_suscriptor\",\"$this->numero_perito\",\"$this->domicilio_suscriptor\",\"$this->observaciones\",\"$this->pdf\")";
			return Executor::doit($sql);
		}
		/*Falta editar ek uodate*/
		public function update(){
			$sql = "update ".self::$tablename." set vigencia1=\"$this->vigencia1\",vigencia2=\"$this->vigencia2\",nombre_solicitante=\"$this->nombre_solicitante\",domicilio_solicitante=\"$this->domicilio_solicitante\",ciudad_solicitante=\"$this->ciudad_solicitante\",telefono_solicitante=\"$this->telefono_solicitante\",predial_obra=\"$this->predial_obra\",ubicacion_obra=\"$this->ubicacion_obra\",destino_obra=\"$this->destino_obra\",superficie_obra=\"$this->superficie_obra\",documentos_obra=\"$this->documentos_obra\",nombre_suscriptor=\"$this->nombre_suscriptor\",numero_perito=\"$this->numero_perito\",domicilio_suscriptor=\"$this->domicilio_suscriptor\",observaciones=\"$this->observaciones\" where numero_licencia=$this->numero_licencia";
			Executor::doit($sql);
		}
		
		public static function getById($numero_licencia){
			$sql = "select * from ".self::$tablename." where numero_licencia=$numero_licencia";
			$query = Executor::doit($sql);
			return Model::one($query[0],new ConstruccionData());
		}
		
		
		//funcion para consultar los registros *Todos
		public static function getAll(){
			$sql = "select * from ".self::$tablename;
			$query = Executor::doit($sql);
			return Model::many($query[0],new ConstruccionData());
		}
		//consulta para la paginacion
		public static function getAllByPage($start_from,$limit){
			$sql = "select * from ".self::$tablename." where numero_licencia>=$start_from limit $limit";
			$query = Executor::doit($sql);
			return Model::many($query[0],new ConstruccionData());
		}
		//Consulta para obtener el ultimo id.
		public static function maxid(){
			$sql = "SELECT numero_licencia FROM ".self::$tablename." ORDER BY numero_licencia DESC LIMIT 1";
			$query = Executor::doit($sql);
			return Model::one($query[0],new ConstruccionData());
		}
		public static function getAllRecibo($numero_recibo){
			$sql ="select * from ".self::$tablename." where numero_recibo=$numero_recibo";
			$query = Executor::doit($sql);
			return Model::one($query[0],new ConstruccionData());
		}
		
		public static function getAllByDateOp($start,$end){
			$sql = "select * from ".self::$tablename." where date(fecha) >= \"$start\" and date(fecha) <= \"$end\" order by fecha ASC";
			$query = Executor::doit($sql);
			return Model::many($query[0],new ConstruccionData());
		}

		public function get_json($hash){
			$sql = "SELECT * FROM licenciacons WHERE numero_licencia = $hash";
			$query = Executor::doit($sql);
			$aux = Model::one($query[0],new ConstruccionData());
			$json_array = array('licencia' => $aux);
			echo json_encode($json_array);
		}
		
	}
?>