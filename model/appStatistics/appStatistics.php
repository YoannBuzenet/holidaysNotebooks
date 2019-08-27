<?php 

class Appstatistics {

	public static function statsTrackResultsQuestion(PDO $pdo, User $user, int $question_id, int $course_id, string $success){

		if($success == 'true'){
				$success = 1;
		}
		else{
			$success = 0;
		}

		$sql = "INSERT INTO stats_questions(id_user, global_id, course_id, success, dateEvent) VALUES (?,?,?,?,NOW())";

		$user_id = $user->getId();

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindParam(1, $user_id, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $question_id, PDO::PARAM_INT);
		$pdoStatement->bindParam(3, $course_id, PDO::PARAM_INT);
		$pdoStatement->bindParam(4, $success, PDO::PARAM_INT);
		$pdoStatement->execute();	

	}

	public static function statsTrackCourseBeginning(PDO $pdo, User $user, int $course_id){

		$sql = "INSERT INTO stats_courses(course_id, date_beginning, id_user) VALUES (?, NOW(), ?)";

		$user_id = $user->getId();

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $course_id, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $user_id, PDO::PARAM_INT);
		$pdoStatement->execute();


	}

	public static function statsTrackCourseEnding(PDO $pdo, User $user, int $course_id, int $success_rate){

		$sql = "UPDATE stats_courses SET date_end = NOW(), success_rate = ? WHERE course_id =? AND id_user = ? AND date_end IS NULL";

		$user_id = $user->getId();

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $success_rate, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $course_id, PDO::PARAM_INT);
		$pdoStatement->bindParam(3, $user_id, PDO::PARAM_INT);
		$pdoStatement->execute();

		
	}

	public static function statsCalculateDailyMetrics(PDO $pdo){


		
	}

	public static function getDailyMetrics(PDO $pdo){


		
	}


}

?>