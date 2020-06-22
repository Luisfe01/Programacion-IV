<?php

// Conexion a la base de datos
require_once('bdd.php');

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	
	$idReserva = $_POST['Event'][0];
	$fechainicio = $_POST['Event'][1];
	$fechafinal = $_POST['Event'][2];

	$sql = "UPDATE reservas SET  fechainicio = '$fechainicio', fechafinal = '$fechafinal' WHERE idReserva = $idReserva ";

	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error');
	}else{
		die ('OK');
	}

}

	
?>
