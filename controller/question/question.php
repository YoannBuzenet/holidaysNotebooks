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

			
			//If there's a picture, we upload it and associate it in DB after the questiob creation
			if(isset($_FILES["question-picture"]) && !empty($_FILES['question-picture']['name'][0])){
				//First, find the question newly created to get its global id
				$question = questionManager::findQuestionWithNameAndIdType($bdd, $question_to_register);
				//Thanks to its global id, we update its url_picture.
				$success = questionManager::updatePictureQuestion($bdd, $question, $_FILES["question-picture"]);
			}

			
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

			//If there's a picture, we upload it and associate it in DB after the questiob creation
			if(isset($_FILES["question-picture"]) && !empty($_FILES['question-picture']['name'][0])){
				$success = questionManager::updatePictureStatementQuestion($bdd, $question_to_edit, $_FILES["question-picture"]);
			}

			if(isset($_FILES["solution-picture"]) && !empty($_FILES['solution-picture']['name'][0])){
				$success = questionManager::updatePictureSolutionQuestion($bdd, $question_to_edit, $_FILES["solution-picture"]);
			}


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
   				elseif($e->getMessage() == "SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`courses`.`course_questions`, CONSTRAINT `Integrity_Questions` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`))"){
   					$message = "Cette question est actuellement utilisée dans un parcours. Elle ne peut être supprimée.";
   				}
   				else{
   					$message = $e->getMessage();
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