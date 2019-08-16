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
			$question_to_register->setSolutionNumber($_POST['solution_number']);


			$success = questionManager::insertQuestion($bdd, $question_to_register);
			$message = "La question a bien été ajoutée en base de données.";
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
			$question_to_edit = new Question;
			$question_to_edit->setName($_POST['name']);
			$question_to_edit->setIdType($_POST['question-type']);
			$question_to_edit->setIdDiscipline($_POST['question-discipline']);
			$question_to_edit->setIdSchoolLevel($_POST['question-school_level']);
			$question_to_edit->setEnonce($_POST['enonce']);
			$question_to_edit->setAnswer1($_POST['answer1']);
			$question_to_edit->setAnswer2($_POST['answer2']);
			$question_to_edit->setAnswer3($_POST['answer3']);
			$question_to_edit->setAnswer4($_POST['answer4']);
			$question_to_edit->setSoluce($_POST['soluce']);
			$question_to_edit->setSolutionNumber($_POST['solution_number']);
			$question_to_edit->setGlobalId($id);

			$success = questionManager::updateQuestion($bdd, $question_to_edit);
			$message = "La question a bien été modifiée.";

			$listQuestions = questionManager::getAllQuestions($bdd);
			include('view/back/question/all_questions.php');
		
		break;

		case "4":

			try{
				$success = questionManager::deleteQuestion($bdd, $id);
				$message = "La question a bien été supprimée.";
			}
			catch(Exception $e) {
				$problem = true;
   				if($e->getMessage() == "SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`courses`.`course-questions`, CONSTRAINT `Integrity_Questions` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`))"){
   					$message = "Cette question est actuellement utilisée dans un parcours. Elle ne peut être supprimée.";
   				}
			}
			
			
			$listQuestions = questionManager::getAllQuestions($bdd);
			include('view/back/question/all_questions.php');

	}
}
else{
	include('view/front/home.php');
}


?>