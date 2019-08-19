<?php


if(isset($_POST['jsonArray'])){

	$json_array = $_POST['jsonArray'];

	$json_array = json_decode($json_array);

	foreach ($json_array as $question) {
		echo $question->order;
		echo $question->globalId;
	}

		//CREER UN PACOURS NULL POUR AVOIR L ID
		//ENREGISTRER TOUTES LES ASSOCIATIONS DANS LA TABLE INTERMEDIAIRE AVEC L ID
		// SEND BACK COURSE ID
	echo'bien reçu';

}

?>