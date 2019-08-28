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

		//Gathering Data

		//Number of questions done yesterday by users
		$sql = "SELECT COUNT(*) AS number_of_questions FROM stats_questions WHERE dateEvent >= DATE_SUB(DATE(NOW()), INTERVAL 1 DAY)";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();
		$result = $pdoStatement->fetch(); 
		$number_of_questions_done_yesterday = $result['number_of_questions'];

		//Number of different users yesterday
		$sql = "SELECT COUNT(DISTINCT id_user) AS number_of_users FROM stats_questions WHERE dateEvent >= DATE_SUB(DATE(NOW()), INTERVAL 1 DAY)";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();
		$result = $pdoStatement->fetch(); 
		$number_of_different_users_yesterday = $result['number_of_users'];

		//Number of courses done yesterday
		$sql = "SELECT COUNT(*) AS number_of_courses FROM stats_courses WHERE date_beginning >= DATE_SUB(DATE(NOW()), INTERVAL 1 DAY)";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();
		$result = $pdoStatement->fetch(); 
		$number_of_courses_done_yesterday = $result['number_of_courses'];


		//Inserting it in the global daily metrics table

		$sql = "INSERT INTO metrics_global(today_quantities_questions, today_number_of_users, today_quantities_courses) VALUES (?, ?, ?)";


		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $number_of_questions_done_yesterday, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $number_of_different_users_yesterday, PDO::PARAM_INT);
		$pdoStatement->bindParam(3, $number_of_courses_done_yesterday, PDO::PARAM_INT);
		$pdoStatement->execute();

		
	}

	public static function getDailyMetrics(PDO $pdo){

		$sql = "SELECT *, DATE_FORMAT(dateMetric, '%d %m %y') AS simplified_date FROM metrics_global";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->execute();
		$result = $pdoStatement->fetchAll(); 

		return $result;


		
	}


}

?>