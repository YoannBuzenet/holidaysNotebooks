<?php 

include('model/question/Question.php');

class questionManager {

	public static function getAllQuestions($pdo){

		$sql = "SELECT q.id, qtr.name, qtr.success_rate, d.discipline, atoq.type  FROM questions q INNER JOIN questions_type_radio qtr ON q.id = qtr.global_id INNER JOIN disciplines d ON d.id = qtr.id_discipline INNER JOIN all_types_of_questions atoq ON qtr.id_type = atoq.id ORDER BY id";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Question");

	}

	public static function getAllTypes($pdo){

		$sql = "SELECT * FROM all_types_of_questions";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll();

	}

	public static function getAllDisciplines($pdo){

		$sql = "SELECT * FROM disciplines";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll();

	}

	public static function getAllSchoolLevel($pdo){

		$sql = "SELECT * FROM school_levels";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();

	return $pdoStatement->fetchAll();

	}


}


?>