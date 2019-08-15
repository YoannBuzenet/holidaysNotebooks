<?php 

include('model/question/questionManager.php');

if(userManager::checkIfAdmin($_SESSION['user'])){

	switch($action){

		case "1":
		$listQuestions = questionManager::getAllQuestions($bdd);
		include('view/back/question/all_questions.php');
		break;

		case "2":
		$list_of_types = questionManager::getAllTypes($bdd);
		$list_of_disciplines = questionManager::getAllDisciplines($bdd);
		$list_of_school_level = questionManager::getAllSchoolLevel($bdd);
		include('view/back/question/create.php');
		break;

		case "2V":
		echo "je suis censé enregistrer lol";
		break;
	}
}
else{
	include('view/front/home.php');
}


?>