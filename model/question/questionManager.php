<?php 

include('model/question/Question.php');

class questionManager {

	public static function getAllQuestions($pdo){

	$sql = "SELECT q.id, qtr.name, qtr.success_rate, d.discipline  FROM questions q INNER JOIN questions_type_radio qtr ON q.id = qtr.global_id INNER JOIN disciplines d ON d.id = qtr.id_discipline ORDER BY id";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->execute();

	return $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Question");

	}


}


?>