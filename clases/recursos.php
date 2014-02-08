<?php
class Recursos{
	public static function filtro_nombre($parString){
		$cadena = (string) $parString;
		$noPermitidos = array("º","ª","!","|","@","·","#","$","%","&","¬","/","(",")","=","?","¿","¡","]","*","+","[","^","`","´","¨","{","}","ç",".",",",";","€","'");
		$sustitucion = array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
		$cadena = str_replace('"','',$cadena);
		return str_replace($noPermitidos, $sustitucion, $cadena);	
	}
	
	public static function filtro_url($parString){
		$cadena = (string) $parString;
		$noPermitidos = array("á","é","í","ó","ú","ä","ë","ï","ö","ü","à","è","ì","ò","ù","ñ"," ",",",".",";",":","¡","!","¿","?","/","*","+","´","{","}","¨","â","ê","î","ô","û", "^","#","|","°","=","[","]","<",">","`","(",")","&","%","$","¬", "@","Á","É","Í","Ó","Ú","Ä","Ë","Ï","Ö","Ü","Â","Ê","Î","Ô","Û","~","À","È","Ì","Ò","Ù","_","\\"); 
		$sustitucion = array("a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","n","-","","","","","","","","","","","","","","","","a","e","i","o","u","","","","","", "","","","","","","","","","","","","A","E","I","O","U","A","E","I","O", "U","A","E","I","O","U","","A","E","I","O","U","-","");
		return str_replace($noPermitidos, $sustitucion, $cadena); 
	}
	
	public static function incluye_clase($nombreClase){
		if(!isset($nombreClase) && file_exists(dirname(__FILE__).'/'.strtolower($nombreClase).'.php')){
			include_once(dirname(__FILE__).'/'.strtolower($nombreClase).'.php');
		}
	}
}
?>