<?php 

include_once('model/question/Question.php');

class questionManager {

	public static function getAllQuestions(PDO $pdo){

		$sql = "SELECT q.id, qtr.name, qtr.success_rate, d.discipline, atoq.type  
				FROM questions q 
				INNER JOIN questions_type_radio qtr ON q.id = qtr.global_id 
				INNER JOIN disciplines d ON d.id = qtr.id_discipline 
				INNER JOIN all_types_of_questions atoq ON qtr.id_type = atoq.id 
				ORDER BY id";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Question");

	}

	public static function getAllTypes(PDO $pdo){

		$sql = "SELECT * FROM all_types_of_questions";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll();

	}

	public static function getIdInfos(PDO $pdo, string $type){

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

		$result = questionManager::getIdInfos($pdo, $question->getType());
		$id_type = $result['id'];

		//Desassembling the $question
		$question_name = $question->getName();

		//writing FIRST in the global questions table, then the detailed one
		$sql = "INSERT INTO questions(name,id_type, created_at) VALUES (?, ?, NOW())";

		$pdoStatement = $pdo->prepare($sql);

		//Binding Params
		$pdoStatement->bindParam(1, $question_name, PDO::PARAM_STR);
		$pdoStatement->bindParam(2, $id_type, PDO::PARAM_INT);
		$pdoStatement->execute();

		//If it worked, we write data in the relevant table with all details
		if($pdoStatement->rowCount()>0){
			echo "dans le bon if <br>";
			//Getting global ID to put it into the detailed table
			$global_id_question = questionManager::getGlobalIdQuestion($pdo, $question);
			
			//Getting the type name to write into the good SQL table
			$table_to_register = 'questions_type_'.$result['type'];

			$sql = "INSERT INTO ".$table_to_register."(enonce, answ1, answ2, answ3, answ4, solution, id_type, id_discipline, id_school_level, name, success_rate, global_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$pdoStatement = $pdo->prepare($sql);
			
			//Desassembling for BindParam
			$enonce = $question->getEnonce();
			$answ1 = $question->getAnswer1();
			$answ2 = $question->getAnswer2();
			$answ3 = $question->getAnswer3();
			$answ4 = $question->getAnswer4();
			$solution = $question->getSoluce();
			$id_type = $result['id'];
			$id_discipline = $question->getDiscipline();
			$id_school_level =$question->getSchoolLevel();
			$name =$question->getName();
			$success_rate = 0;

			$pdoStatement->bindParam(1, $enonce, PDO::PARAM_STR);
			$pdoStatement->bindParam(2, $answ1, PDO::PARAM_STR);
			$pdoStatement->bindParam(3, $answ2, PDO::PARAM_STR);
			$pdoStatement->bindParam(4, $answ3, PDO::PARAM_STR);
			$pdoStatement->bindParam(5, $answ4, PDO::PARAM_STR);
			$pdoStatement->bindParam(6, $solution, PDO::PARAM_STR);
			$pdoStatement->bindParam(7, $id_type, PDO::PARAM_INT);
			$pdoStatement->bindParam(8, $id_discipline, PDO::PARAM_INT);
			$pdoStatement->bindParam(9, $id_school_level, PDO::PARAM_INT);
			$pdoStatement->bindParam(10, $name, PDO::PARAM_STR);
			$pdoStatement->bindParam(11, $success_rate, PDO::PARAM_INT);
			$pdoStatement->bindParam(12, $global_id_question, PDO::PARAM_INT);

			$pdoStatement->execute();

			if($pdoStatement->rowCount()>0){
				echo"ok";
			}
			else{
				echo "pas ok";
			}

			//continue
			//write all details in small table

		}
		else {
			echo"error";
			//throw error
		}



		return $pdoStatement->rowCount();

	}


}


?>