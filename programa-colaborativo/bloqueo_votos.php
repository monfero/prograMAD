<?php
include_once "lib/functions.php";


if(isset ($_POST['propuesta'])){

	$propuesta=$_POST['propuesta'];
	$usuario=$_POST['usuario_id'];

	try{
	$conn = new PDO('mysql:host=localhost;dbname=NOMBREDB', 'USUARIO', 'PASSWORD');
	$consulta = "SELECT propuesta_voto FROM prog_likes_propuesta 
	WHERE usuario_id=".$usuario." and propuesta_id = ".$propuesta.";";
	$result = $conn->prepare($consulta);
	$result->execute();
	//Se crea array vacío
	$output= array();
	foreach($result as $res){
		$like=$res['propuesta_voto'];
	}
	//si el voto es postivo
	if ($like==1){
		$block="prop_favor";
	}
	//si el voto es negativo
	if ($like==-1){
		$block="prop_contra";
	}


	//Array serializado para pasar datos con json.
	$output[] = array('activo' => $block);
	echo json_encode($output);
		
	}catch(PDOException $e ){
		echo $e -> getMessage();
	}
}