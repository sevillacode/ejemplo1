<?php
class Model_Fichas{
	const CAMPO_IDENTIFICADOR = 'id_ficha';
	
	protected $nombre;
	protected $id_ficha;
	protected $descripcion;
	protected $id_provincia;
	protected $id_usuario;
	protected $localizacion;
	protected $estado;
	protected $tipo;
	
	///private $db;
	
	
	public static function get_id(){		return $this->id_ficha;			}
	public function get_nombre(){			return $this->nombre;			}
	public function get_id_ficha(){			return $this->id_ficha;			}
	public function get_descripcion(){		return $this->descripcion;		}
	public function get_id_provincia(){		return $this->id_provincia;		}
	public function get_id_usuario(){		return $this->id_usuario;		}
	public function get_localizacion(){		return $this->localizacion;		}
	public function get_estado(){			return $this->estado;			}
	public function get_tipo(){				return $this->tipo;				}
	
	public function set_nombre($par){			$this->nombre = $par;			}
	public function set_id_ficha($par){			$this->id_ficha = $par;			}
	public function set_descripcion($par){		$this->descripcion = $par;		}
	public function set_id_provincia($par){		$this->id_provincia = $par;		}
	public function set_id_usuario($par){		$this->id_usuario = $par;		}
	public function set_localizacion($par){		$this->localizacion = $par;		}
	public function set_estado($par){			$this->estado = $par;			}
	public function set_tipo($par){				$this->tipo = $par;				}
	
	function __construct(){ 
	////	$this->db = DB::getInstance();
		$this->nombre = null;
		$this->id_ficha = null;
		$this->descripcion = null;
		$this->id_provincia = null;
		$this->id_usuario = null;
		$this->localizacion = null;
		$this->estado = null;
		$this->tipo = null;
	}
}		

class Controller_Fichas extends Model_Fichas{

	private $db;
	private $manejacrud;

	function __construct(){ 
		$this->db = DB::getInstance();
		$this->manejaCrud = new CRUD;
	}


	public function dame(){
		$args = (!empty(func_get_args())) ? func_get_args() : null;
		$this->obtener($args);
	}

	protected function obtener($id_ficha = null, $id_usuario = null, $id_provincia = null){
		$sql = 'SELECT * FROM `fichas` WHERE `del` = 0';
		$param = array();
		if(!is_null($id_ficha)){
			$sql = ' AND id_ficha = :id_ficha';
			$param[':id_ficha'] = $this->db->sanitizar($id_ficha);
		}
		if(!is_null($id_usuario)){
			$sql .= ' AND id_usuario = :id_usuario';
			$param[':id_usuario'] = $this->db->sanitizar($id_usuario);
		}
		if(!is_null($id_provincia)){
			$sql .= ' AND id_provincia = :id_provincia';
			$param[':id_provincia'] = $this->db->sanitizar($id_provincia);
		}
		 echo '<pre>';
		 print_r($this);
		 echo '</pre>';
		 echo $sql;
		 
		$statement = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		var_dump($statement);
		$statement->execute($param);
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$array_elementos = array();
		while($row = $statement->fetch()) {  
			// echo '<pre>';
			// print_r($row);		   
			// echo '</pre>'; 
			$objFichas = new Fichas;
			foreach($row as $key => $value){
				$objFichas->$key = $value;
			}
			$array_elementos[] = $objFichas;
		}
		// echo '<pre>';
		// print_r($array_elementos);		   
		// echo '</pre>';
		return $array_elementos;
	}
	
	public function crear(){
		$arr['tabla'] = strtolower(__CLASS__);
		$arr['valores'] = array();
		foreach(get_class_vars(__CLASS__) as $propiedad => $valor){
			if($propiedad != 'db'){
				// array_push(&$arr['valores'], array($propiedad => $this->$propiedad)); // array key numerico
				$arr['valores'][$propiedad] = $this->$propiedad;
			}
		}
		return CRUD::insertar($arr);
	}
	
	public function actualizar(){
		$arr['identificador'] = CAMPO_IDENTIFICADOR;
		$arr['tabla'] = strtolower(__CLASS__);
		// $arr['instancia'] = $this;
		$arr['instancia'] = $this->get_id();
		$arr['valores'] = array();
		foreach(get_class_vars(__CLASS__) as $propiedad => $valor){
			if($propiedad != 'db'){
				// array_push(&$arr['valores'], array($propiedad => $this->$propiedad)); // array key numerico
				$arr['valores'][$propiedad] = $this->$propiedad;
			}
		}
		return CRUD::modificar($arr);
	}
}
?>