<?php 
/**
* PHP5 PDO Singleton Class v.1
*
* @author Evren Yalcin
* @link http://www.evrenyalcin.com
*
*/ 
class DB {
	protected static $instance;
	
	protected function __construct(){}
	
	public static function getInstance(){        
		// var_dump(self::$instance);
		// echo '<br><br><br><br>';
		if(empty(self::$instance)){
			$db_info = array(
				"db_host" => DB_HOST,
				"db_port" => DB_PORT,
				"db_user" => DB_USER,
				"db_pass" => DB_PASS,
				"db_name" => DB_NAME,
				"db_charset" => DB_CHARSET
			);
			
			try{
				self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
				self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
				self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				// self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->query('SET NAMES utf8');
				self::$instance->query('SET CHARACTER SET utf8');
			}catch(PDOException $e){
				echo $e->getMessage();  
			}
		}
		return self::$instance;
	}
}
?>