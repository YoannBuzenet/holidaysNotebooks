<?php 

include('model/question/questionManager.php');

if(userManager::checkIfAdmin($_SESSION['user'])){

	switch($action){

		case "1":
		$listQuestions = questionManager::getAllQuestions($bdd);
		include('view/back/question/all_questions.php');
		break;

		case "2":
		echo "blibli";
		break;
	}
}
else{
	include('view/front/home.php');
}


?>