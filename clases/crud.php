<?php
class CRUD extends Seguridad{
	private $db;
	
	public function insertar(){
		$params = func_get_args();
		if(isset($params[0]['tabla']) && isset($params[0]['valores']) && is_array($params[0]['valores'])){
			$columnas = '';
			$valoresArg = '';
			$a = 0;
			$param = array();
			foreach($params[0]['valores'] as $campo => $valor){
				if($a > 0){
					$columnas .= ',';
					$valoresArg .= ',';
				}
				$columnas .= $campo;
				$valoresArg .= ':'.$campo;
				$param[':'.$campo] = parent::sanitizar($valor);
				$a++;
			}
			$db = DB::getInstance();
			$sql = "INSERT INTO ".parent::sanitizar($params[0]['tabla'])." (".$columnas.") VALUES (".$valoresArg.")";
			$statement = $db->prepare($sql);
			$statement->execute($param);
			$ret = $db->lastInsertId();
			unset($db);
			return $ret;
		}
	}
	
	public function modificar(){
		$params = func_get_args();
		if(isset($params[0]['tabla']) && isset($params[0]['valores']) && is_array($params[0]['valores']) && isset($params[0]['identificador'])){
			$sql = "UPDATE ".parent::sanitizar($params[0]['tabla'])." SET ";
			$param = array();
			foreach($params[0]['valores'] as $campo => $valor){
				$sql .= $campo."=:".$campo.",";
				$param[':'.$campo] = parent::sanitizar($valor);
			}
			$sql = trim($sql, ',');
			// var_dump($params[0]['instancia']);
			$param[':id'] = parent::sanitizar($params[0]['instancia']); // debe haber un metodo mejor
			$sql .= "WHERE ".parent::sanitizar($params[0]['identificador'])."=:id";
			$db = DB::getInstance();
			// $sql = "UPDATE mitabla SET borrado='s',cometa='',otro='' WHERE id_ = ''";
			//(".$columnas.") VALUES (".$valoresArg.")";
			$statement = $db->prepare($sql);
			$statement->execute($param);
			$ret = $db->lastInsertId();
			unset($db);
			return $ret;
		}
	}
	
	protected function eliminar(){
		
	}
}
?>