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
			$question_to_register = new Question;
			$question_to_register->setName($_POST['name']);
			$question_to_register->setIdType($_POST['question-type']);
			$question_to_register->setIdDiscipline($_POST['question-discipline']);
			$question_to_register->setIdSchoolLevel($_POST['question-school_level']);
			$question_to_register->setEnonce($_POST['enonce']);
			$question_to_register->setAnswer1($_POST['answer1']);
			$question_to_register->setAnswer2($_POST['answer2']);
			$question_to_register->setAnswer3($_POST['answer3']);
			$question_to_register->setAnswer4($_POST['answer4']);
			$question_to_register->setSoluce($_POST['soluce']);

			$success = questionManager::insertQuestion($bdd, $question_to_register);

			$listQuestions = questionManager::getAllQuestions($bdd);
		include('view/back/question/all_questions.php');
		break;

		case "3":
			$question_to_edit = questionManager::getQuestionById($bdd, $id);
			$list_of_types = questionManager::getAllTypes($bdd);
			$list_of_disciplines = questionManager::getAllDisciplines($bdd);
			$list_of_school_level = questionManager::getAllSchoolLevel($bdd);
		include('view/back/question/update.php');
		break;

		case "3V":
		
		break;
	}
}
else{
	include('view/front/home.php');
}


?>