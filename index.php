<?php
include_once(dirname(__FILE__).'/conf/config.php');
include_once(dirname(__FILE__).'/clases/pdo.php');
include_once(dirname(__FILE__).'/clases/seguridad.php');
include_once(dirname(__FILE__).'/clases/crud.php');
include_once(dirname(__FILE__).'/clases/fichas.php');
$urlTemp = dirname(__FILE__).'/normal/index.tpl';

// $temp = abre($urlTemp);


$fichas = new Fichas();
// comentario simple


if($_GET['i']){
	$fichas->set_nombre('prueba insertada');
	// $fichas->id_ficha = '';
	$fichas->set_descripcion('descripcion de laficha insertada');
	$fichas->set_id_provincia('40');
	$fichas->set_id_usuario('2');
	$fichas->set_localizacion('ciudad');
	$fichas->set_estado('1');
	$fichas->set_tipo('1');
	$fichas->crear();
}
if($_GET['m']){
	$lfichas = $fichas->obtener(1);
	echo '<br>El objeto cambio a '.$lfichas[0]->get_nombre();
	$lfichas[0]->set_nombre('mod nombre');
	
	$lfichas[0]->set_descripcion('descripcion MOD de laficha insertada');
	$lfichas[0]->set_estado('1');
	$lfichas[0]->set_tipo('1');
	$lfichas[0]->actualizar();
	
	echo '<br>El objeto cambio a '.$lfichas[0]->get_nombre();
}

$listafichas = $fichas->obtener();
// echo '<pre>';
// print_r($listafichas);
// echo '</pre>';
for($q=0;$q<count($listafichas);$q++){
	echo $listafichas[$q]->get_nombre().' - ';
	if($q == 4){
		// $no = new Fichas;
		// $rrr = $no->obtener($listafichas[$q]->get_id());
		$listafichas[$q]->set_nombre('Nombre modificado al vuelo');
		$listafichas[$q]->actualizar();
		// echo '<br>'.$listafichas[$q].'<br>';
		// print_r($listafichas[$q]);
	}
	echo $listafichas[$q]->get_nombre();
	echo '<br>';

}
echo '22222';
$lf2 = $fichas->obtener();

echo 'd';
for($q=0;$q<count($lf2);$q++){
	echo '<br>Segunda pasada '.$lf2[$q]->get_nombre();
}

?>