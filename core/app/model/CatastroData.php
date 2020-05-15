<?php
	class CatastroData{
		public static $tablename="predios_registrados";
		
		//funcion para consultar los registros *Todos
		public static function getAllnu(){
			$sql = "select * from ".self::$tablename;
			$query = Executor::doit($sql);
			return Model::many($query[0],new CatastroData());
		}
		
		public static function getcvn($idc,$idv,$noe){
			$sql = "select * from ".self::$tablename." where cve_colonia=$idc and cve_vialidad=$idv and no_ext=$noe";
			$query = Executor::doit($sql);
			return Model::many($query[0],new CatastroData());
		}
		
		public static function getcv($idc,$idv){
			$sql = "select * from ".self::$tablename." where cve_colonia=$idc and cve_vialidad=$idv";
			$query = Executor::doit($sql);
			return Model::many($query[0],new CatastroData());
		}
		
	}
?>