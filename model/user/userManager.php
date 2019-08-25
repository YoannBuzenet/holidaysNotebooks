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

	public static function updateUserProgress(PDO $pdo, User $user, int $newQuestionOrder){

		//update

	}
	
	
}

?>