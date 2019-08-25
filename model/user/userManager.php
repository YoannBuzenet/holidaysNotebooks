<?php 

include_once('model/user/User.php');

class UserManager {

	//CRUD User to do

	public static function checkIfAdmin(User $user){
		if($user->getPermission_access() == 'admin'){
			return true;
		}
		else{
			return false;
		}
		
	}

	public static function checkIfLogged(User $user){

		if($user->getLogged() == 'logged'){
			return true;
		}
		else{
			return false;
		}
		
	}

	public static function registerCookieInDB(PDO $pdo, string $cookie_id){

		$sql = "INSERT INTO users(id_cookie) VALUES (?)";

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindParam(1, $cookie_id, PDO::PARAM_STR);

		$pdoStatement->execute();

		return $pdoStatement->rowCount();

	}

	public static function getUserIDWithCookieID(PDO $pdo, string $cookie_id){

		$sql = "SELECT id FROM users WHERE id_cookie = ?";

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindParam(1, $cookie_id, PDO::PARAM_STR);

		$pdoStatement->execute();

		return $pdoStatement->fetch();


	}

	public static function getUserProgress(PDO $pdo, int $user_id){

		$sql = "SELECT course_id, last_question_number FROM users_courses WHERE user_id = ?";

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $user_id, PDO::PARAM_STR);
		$pdoStatement->execute();
		$results = $pdoStatement->fetchAll();	

		//We are sorting the result in an associative array : key is id_course, value is last_number_question.
		//This is the global progress save file for the user.

		$user_progress = [];

		foreach($results as $result){
			$user_progress[$result['course_id']] = $result['last_question_number'];
		}

		//var_dump($user_progress);

		//Returning saved progress results
		return $user_progress;	

	}

	public static function updateUserProgress(PDO $pdo, User $user, int $newQuestionOrder, int $id_course){

		//1. We check if any record already exist.
		//2. If no, we insert that new data.
		//3. If yes, we just update the data.

		//////////////////////////////////
		// 1 - Checking if data already exists.
		//////////////////////////////////

		$sql = "SELECT course_id, last_question_number FROM users_courses WHERE user_id = ? AND course_id = ?";

		$user_id = $user->getId();

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $user_id, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $id_course, PDO::PARAM_INT);
		$pdoStatement->execute();
		$results = $pdoStatement->fetch();	

		//////////////////////////////////
		// 2 - If data doesn't exist, we insert it into DB.
		//////////////////////////////////

		if(!$results){
			//var_dump($results);
			$sql = "INSERT INTO users_courses(user_id,course_id, last_question_number) VALUES(?,?,?)";

			$user_id = $user->getId();

			$pdoStatement = $pdo->prepare($sql);
			$pdoStatement->bindParam(1, $user_id, PDO::PARAM_INT);
			$pdoStatement->bindParam(2, $id_course, PDO::PARAM_INT);
			$pdoStatement->bindParam(3, $newQuestionOrder, PDO::PARAM_INT);
			$pdoStatement->execute();

		}
		//////////////////////////////////
		// 3 - If data already exists, we update it on DB.
		//////////////////////////////////

		else {
			$sql = "UPDATE users_courses SET last_question_number = ? WHERE user_id=? AND course_id = ? ";

			$user_id = $user->getId();

			$pdoStatement = $pdo->prepare($sql);
			$pdoStatement->bindParam(1, $newQuestionOrder, PDO::PARAM_INT);
			$pdoStatement->bindParam(2, $user_id, PDO::PARAM_INT);
			$pdoStatement->bindParam(3, $id_course, PDO::PARAM_INT);
			$pdoStatement->execute();


		}

		//At the end of the function, inserting and updating data in RAM
		$user_progress = $_SESSION['user']->getUserProgress();
		$user_progress[$id_course] = $newQuestionOrder;
		$_SESSION['user']->setUserProgress($user_progress);
		
	}

	public static function trackResult(PDO $pdo, User $user, string $result, int $course_id, int $question_id){
		if($result == 'true'){
			$result = 1;
		}
		else{
			$result = 0;
		}

		//check si ça existe deja
		$sql = "SELECT id, id_course, id_question, id_user, result FROM result_per_question_per_user WHERE id_user = ? AND id_course = ? AND id_question = ?";

		$user_id = $user->getId();

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindParam(1, $user_id, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $course_id, PDO::PARAM_INT);
		$pdoStatement->bindParam(3, $question_id, PDO::PARAM_INT);
		$pdoStatement->execute();

		$results = $pdoStatement->fetch();	

		//var_dump($results);

		if(!$results){
			//var_dump($results);
			$sql = "INSERT INTO result_per_question_per_user(id_user,id_course, id_question, result) VALUES(?,?,?,?)";

			$user_id = $user->getId();

			$pdoStatement = $pdo->prepare($sql);
			$pdoStatement->bindParam(1, $user_id, PDO::PARAM_INT);
			$pdoStatement->bindParam(2, $course_id, PDO::PARAM_INT);
			$pdoStatement->bindParam(3, $question_id, PDO::PARAM_INT);
			$pdoStatement->bindParam(4, $result, PDO::PARAM_INT);
			$pdoStatement->execute();

		}

		else {
			$sql = "UPDATE result_per_question_per_user SET result = ? WHERE id_user=? AND id_course = ? AND id_question = ?";

			$user_id = $user->getId();
			
			$pdoStatement = $pdo->prepare($sql);
			$pdoStatement->bindParam(1, $result, PDO::PARAM_INT);
			$pdoStatement->bindParam(2, $user_id, PDO::PARAM_INT);
			$pdoStatement->bindParam(3, $course_id, PDO::PARAM_INT);
			$pdoStatement->bindParam(4, $question_id, PDO::PARAM_INT);
			$pdoStatement->execute();

			//var_dump($pdoStatement->rowCount());


		}

	}
	
	
}

?>