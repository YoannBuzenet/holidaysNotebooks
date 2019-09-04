<?php 

include_once('model/question/Question.php');

class questionManager {

	public static function getAllQuestions(PDO $pdo){

		$sql = "SELECT q.id, qtr.name, d.discipline, atoq.type, sl.school_level 
				FROM questions q 
				INNER JOIN questions_type_radio qtr ON q.id = qtr.global_id 
				INNER JOIN disciplines d ON d.id = qtr.id_discipline 
				INNER JOIN all_types_of_questions atoq ON qtr.id_type = atoq.id 
				INNER JOIN school_levels sl ON qtr.id_school_level = sl.id 
				ORDER BY id";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Question");

	}

	public static function getQuestionsWithIdDisciplineAndIdSchoolLevel(PDO $pdo, int $id_discipline, int $id_school_level){

		$sql = "SELECT q.id, qtr.name, d.discipline, atoq.type, sl.school_level 
				FROM questions q 
				INNER JOIN questions_type_radio qtr ON q.id = qtr.global_id 
				INNER JOIN disciplines d ON d.id = qtr.id_discipline 
				INNER JOIN all_types_of_questions atoq ON qtr.id_type = atoq.id 
				INNER JOIN school_levels sl ON qtr.id_school_level = sl.id 
				WHERE d.id = ?
				AND sl.id = ?
				ORDER BY id";

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindParam(1, $id_discipline, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $id_school_level, PDO::PARAM_INT);

		$pdoStatement->execute();

		return $pdoStatement->fetchAll();
	}

	public static function getAllTypes(PDO $pdo){

		$sql = "SELECT * FROM all_types_of_questions";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll();

	}

	public static function getTypeNameByIdType(PDO $pdo, int $typeID){

		$sql = "SELECT * FROM all_types_of_questions WHERE id= ?";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $typeID, PDO::PARAM_INT);
		$pdoStatement->execute();
		$result=$pdoStatement->fetch();

		return $result['type'];
	}

	public static function getIdTypeInfo(PDO $pdo, string $type){

		$sql = "SELECT id,type FROM all_types_of_questions WHERE type = ?";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $type, PDO::PARAM_STR);
		$pdoStatement->execute();

		$result = $pdoStatement->fetch();

	return $result;

	}

	public static function getGlobalIdQuestion(PDO $pdo, Question $question){

		$sql = "SELECT id FROM questions WHERE name = ?";

		$question_name = $question->getName();

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $question_name, PDO::PARAM_STR);
		$pdoStatement->execute();

		$result = $pdoStatement->fetch();

	return $result['id'];

	}

	public static function getAllDisciplines(PDO $pdo){

		$sql = "SELECT * FROM disciplines";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll();

	}

	public static function getAllSchoolLevel(PDO $pdo){

		$sql = "SELECT * FROM school_levels";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll();

	}

	public static function insertQuestion(PDO $pdo, Question $question){

		//Here we do 2 things : 
		// 1. Insert a part of in the info into the global table, which has data about all questions;
		// 2. Insert all details in a dedicated table, following the question type
		//We do this in two steps because questions do not have all the same database structure

		//Desassembling the $question
		$question_name = $question->getName();
		$id_type = $question->getIdType();

		//writing FIRST in the global questions table, then the detailed one
		$sql = "INSERT INTO questions(name,id_type, created_at) VALUES (?, ?, NOW())";

		$pdoStatement = $pdo->prepare($sql);

		//Binding Params
		$pdoStatement->bindParam(1, $question_name, PDO::PARAM_STR);
		$pdoStatement->bindParam(2, $id_type, PDO::PARAM_INT);
		$pdoStatement->execute();

		//If it worked, we write data in the relevant table with all details
		if($pdoStatement->rowCount()>0){
			//Getting global ID to put it into the detailed table
			$global_id_question = questionManager::getGlobalIdQuestion($pdo, $question);
			
			//Getting the type name to write into the good SQL table
			$type_name = questionManager::getTypeNameByIdType($pdo, $id_type);
			$table_to_register = 'questions_type_'.$type_name;

			$sql = "INSERT INTO ".$table_to_register."(url_picture_main, enonce, exercice, answer1, answer2, answer3, answer4, solution, solution_number, url_picture_solution, id_type, id_discipline, id_school_level, name, global_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$pdoStatement = $pdo->prepare($sql);
			
			//Desassembling for BindParam
			//url_picture is set to nul by default, we update it after in the creation
			$url_picture_main = null;
			$enonce = $question->getEnonce();
			$exercice = $question->getExercice();
			$answ1 = $question->getAnswer1();
			$answ2 = $question->getAnswer2();
			$answ3 = $question->getAnswer3();
			$answ4 = $question->getAnswer4();
			$solution = $question->getSoluce();
			$solution_number = $question->getSolutionNumber();
			$url_picture_solution = null;
			$id_type = $question->getIdType();
			$id_discipline = $question->getIdDiscipline();
			$id_school_level =$question->getIdSchoolLevel();
			$name =$question->getName();

			$pdoStatement->bindParam(1, $url_picture_main, PDO::PARAM_STR);
			$pdoStatement->bindParam(2, $enonce, PDO::PARAM_STR);
			$pdoStatement->bindParam(3, $exercice, PDO::PARAM_STR);
			$pdoStatement->bindParam(4, $answ1, PDO::PARAM_STR);
			$pdoStatement->bindParam(5, $answ2, PDO::PARAM_STR);
			$pdoStatement->bindParam(6, $answ3, PDO::PARAM_STR);
			$pdoStatement->bindParam(7, $answ4, PDO::PARAM_STR);
			$pdoStatement->bindParam(8, $solution, PDO::PARAM_STR);
			$pdoStatement->bindParam(9, $solution_number, PDO::PARAM_INT);
			$pdoStatement->bindParam(10, $url_picture_solution, PDO::PARAM_INT);
			$pdoStatement->bindParam(11, $id_type, PDO::PARAM_INT);
			$pdoStatement->bindParam(12, $id_discipline, PDO::PARAM_INT);
			$pdoStatement->bindParam(13, $id_school_level, PDO::PARAM_INT);
			$pdoStatement->bindParam(14, $name, PDO::PARAM_STR);
			$pdoStatement->bindParam(15, $global_id_question, PDO::PARAM_INT);

			$pdoStatement->execute();

			if($pdoStatement->rowCount()>0){

				return $success = true;
			}
			else{
				$error = "Could not register in detailed table";
				throw new Exception($error);
				return $success = false;
			}

		}
		else {
			$error = "Could not register in global table";
			throw new Exception($error);
		}

	}

	
	public static function getQuestionById(PDO $pdo, int $id){

		//get the type in the global question table
		$sql = "SELECT q.id_type, atoq.type 
				FROM questions q 
				INNER JOIN all_types_of_questions atoq ON q.id_type = atoq.id
				WHERE q.id = ?";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $id, PDO::PARAM_INT);
		$pdoStatement->execute();

		$result= $pdoStatement->fetch();

		$question_type = $result['type'];

		//Now going into the right table to get the datas
		$table_to_search = "questions_type_".$question_type;

		$sql="SELECT * FROM ".$table_to_search." WHERE global_id=?";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $id, PDO::PARAM_INT);
		$pdoStatement->execute();

		$result= $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Question");

		return $result[0];
	}

	public static function findQuestionWithNameAndIdType(PDO $pdo, Question $question){

		$type_question_name = questionManager::getTypeNameByIdType($pdo, $question->getIdType());

		$table_name = "questions_type_".strtolower($type_question_name);

		
		$sql = "SELECT * FROM ". $table_name ." WHERE name=?";

		$question_name = $question->getName();

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $question_name, PDO::PARAM_STR);
		$pdoStatement->execute();

		$result= $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Question");

		return $result[0];

	}

	public static function updateQuestion(PDO $pdo, Question $question){

		$sql = "UPDATE questions SET name = ?, id_type = ? WHERE id=?";

		$name = $question->getName();
		$id_type = $question->getIdType();
		$global_id = $question->getGlobalId();

		/*var_dump($name);
		var_dump($id_type);
		var_dump($global_id);*/

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1,$name, PDO::PARAM_STR);
		$pdoStatement->bindParam(2,$id_type, PDO::PARAM_INT);
		$pdoStatement->bindParam(3,$global_id, PDO::PARAM_INT);
		$pdoStatement->execute();


		//Once the first table was updated successfully, we update the second, the more detailed one
			$sql = "UPDATE questions_type_radio SET enonce = ?, exercice = ?, answer1 = ?, answer2 = ?, answer3 = ?, answer4 = ?, solution = ?, solution_number = ?, id_discipline = ?, id_school_level = ?, name = ?, id_type = ? WHERE global_id=?";

			$pdoStatement = $pdo->prepare($sql);

			$enonce = $question->getEnonce();	
			$exercice = $question->getExercice();
			$Answer1 = $question->getAnswer1();		
			$Answer2 = $question->getAnswer2();		
			$Answer3 = $question->getAnswer3();		
			$Answer4 = $question->getAnswer4();		
			$solution = $question->getSoluce();
			$solution_number = $question->getSolutionNumber();
			$id_discipline = $question->getIdDiscipline();
			$id_school_level = $question->getIdSchoolLevel();
			$name = $question->getName();
			$id_type = $question->getIdType();
			$id = $question->getGlobalId();

			$pdoStatement->bindParam(1, $enonce, PDO::PARAM_STR);
			$pdoStatement->bindParam(2, $exercice, PDO::PARAM_STR);
			$pdoStatement->bindParam(3, $Answer1, PDO::PARAM_STR);
			$pdoStatement->bindParam(4, $Answer2, PDO::PARAM_STR);
			$pdoStatement->bindParam(5, $Answer3, PDO::PARAM_STR);
			$pdoStatement->bindParam(6, $Answer4, PDO::PARAM_STR);
			$pdoStatement->bindParam(7, $solution, PDO::PARAM_STR);
			$pdoStatement->bindParam(8, $solution_number, PDO::PARAM_INT);
			$pdoStatement->bindParam(9, $id_discipline, PDO::PARAM_INT);
			$pdoStatement->bindParam(10, $id_school_level, PDO::PARAM_INT);
			$pdoStatement->bindParam(11, $name, PDO::PARAM_STR);
			$pdoStatement->bindParam(12, $id_type, PDO::PARAM_INT);
			$pdoStatement->bindParam(13, $id, PDO::PARAM_INT);
			$pdoStatement->execute();

			if($pdoStatement->rowCount()>0){
				return $success = true;
			}
			else{
				$error = "Could not update in detailed table";
				throw new Exception($error);
				return $success = false;
			}

	}

	public static function deleteQuestion(PDO $pdo, int $id){

		$sql = "DELETE FROM questions WHERE id=?";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $id, PDO::PARAM_INT);
		$pdoStatement->execute();

		return $pdoStatement->rowCount();

	}

	public static function getNextQuestion(PDO $pdo, int $course_id, int $next_question){

	//Get the next question of a course + the total number of question in the current course

	$sql = "SELECT (SELECT COUNT(id_question) FROM course_questions WHERE id_course=?) as total_questions, cq.id_course, cq.order_question as order_number, qtr.enonce, qtr.answer1, qtr.answer2, qtr.answer3, qtr.answer4, qtr.solution, qtr.solution_number, qtr.id_discipline, qtr.id_school_level, qtr.name as name, qtr.id_type , d.discipline, cq.id_question, qtr.url_picture_main, qtr.url_picture_solution, qtr.exercice
			FROM course_questions cq
			INNER JOIN questions_type_radio qtr ON cq.id_question = qtr.global_id
			INNER JOIN school_levels sl ON qtr.id_school_level = sl.id
			INNER JOIN disciplines d ON qtr.id_discipline = d.id
			WHERE cq.id_course = ?
			AND cq.order_question = ?
			";

	$pdoStatement = $pdo->prepare($sql);

	$pdoStatement->bindParam(1, $course_id, PDO::PARAM_INT);
	$pdoStatement->bindParam(2, $course_id, PDO::PARAM_INT);
	$pdoStatement->bindParam(3, $next_question, PDO::PARAM_INT);
	$pdoStatement->execute();
	$pdoStatement->setFetchMode(PDO::FETCH_CLASS, "Question");

	return $pdoStatement->fetch();

}

public static function getSolution(PDO $pdo, int $id_question){

	$sql = "SELECT solution, solution_number, url_picture_solution FROM questions_type_radio WHERE global_id = ?";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindParam(1, $id_question, PDO::PARAM_INT);
	$pdoStatement->execute();
	return $pdoStatement->fetch();
}

public static function updatePictureStatementQuestion(PDO $pdo, Question $question, $file){

	//////////////////////////////////
	// 1 - Saving the picture
	//////////////////////////////////

	$target_dir = "public/pictures/questions/";
	$target_file = $target_dir . basename($file["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// if everything is ok, try to upload file
	move_uploaded_file($_FILES["question-picture"]["tmp_name"], $target_file); 

	//////////////////////////////////
	// 2 - Updating the link in DB
	//////////////////////////////////


	//getting the right table name for question
	$type_question_name = questionManager::getTypeNameByIdType($pdo, $question->getIdType());

	$table_name = "questions_type_".strtolower($type_question_name);

	//updating the URL path of the question picture once we know the good table
	$sql = "UPDATE ". $table_name ." SET url_picture_main = ? WHERE global_id=?";

	$global_id = $question->getGlobalId();

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindParam(1, $target_file, PDO::PARAM_STR);
	$pdoStatement->bindParam(2, $global_id, PDO::PARAM_INT);
	$pdoStatement->execute();

	return $pdoStatement->rowCount();
}

public static function updatePictureSolutionQuestion(PDO $pdo, Question $question, $file){

	//////////////////////////////////
	// 1 - Saving the picture
	//////////////////////////////////

	$target_dir = "public/pictures/questions/";
	$target_file = $target_dir . basename($file["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// if everything is ok, try to upload file
	move_uploaded_file($_FILES["solution-picture"]["tmp_name"], $target_file); 

	//////////////////////////////////
	// 2 - Updating the link in DB
	//////////////////////////////////


	//getting the right table name for question
	$type_question_name = questionManager::getTypeNameByIdType($pdo, $question->getIdType());

	$table_name = "questions_type_".strtolower($type_question_name);

	//updating the URL path of the question picture once we know the good table
	$sql = "UPDATE ". $table_name ." SET url_picture_solution = ? WHERE global_id=?";

	$global_id = $question->getGlobalId();

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindParam(1, $target_file, PDO::PARAM_STR);
	$pdoStatement->bindParam(2, $global_id, PDO::PARAM_INT);
	$pdoStatement->execute();

	return $pdoStatement->rowCount();
}

}


?>