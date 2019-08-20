<?php 

include('model/course/Course.php');

class CourseManager{


public static function getAllCourses($pdo){

	$sql = "SELECT * FROM courses ORDER BY id";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->execute();

	return $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Course");
}

public static function registerCourse(PDO $pdo, $post, $file){

	var_dump($post);


	//Saving the picture
	$target_dir = "public/pictures/courses/";
	$target_file = $target_dir . basename($file["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// if everything is ok, try to upload file
	move_uploaded_file($_FILES["course-picture"]["tmp_name"], $target_file); 

	//insert into bdd
	$course_name = $_POST['course-name'];

	$sql = "INSERT INTO courses(name, url_picture) VALUES (?,?)";

	$pdoStatement = $pdo->prepare($sql);

	$pdoStatement->bindParam(1, $course_name, PDO::PARAM_STR);
	$pdoStatement->bindParam(2, $target_file, PDO::PARAM_STR);
	$pdoStatement->execute();

	//get the most recent course and take the id
	$sql = "SELECT * FROM courses ORDER BY id DESC LIMIT 1";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->execute();
	$result = $pdoStatement->fetch();

	$id = $result['id'];
	$id = intval($id);


	//us the id to save the intermediary table

	$questions_orders = array();
	$id_question = null;
	$order_question = null;
	
	foreach ($post as $key => $value) {
		//var_dump($post);
		if(preg_match('#^order#', $key)){
			$order_question = intval($value);
		}

		if(preg_match('#^question#', $key)){
			$id_question = intval($value);
		}
		$questions_orders[$order_question] = $id_question;
	}
	//var_dump($questions_orders);

	foreach ($questions_orders as $order => $question) {
		$sql = "INSERT INTO course_questions(order_question, id_question, id_course) VALUES (?,?,?)";

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindParam(1, $order, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $question, PDO::PARAM_INT);
		$pdoStatement->bindParam(3, $id, PDO::PARAM_INT);
		$pdoStatement->execute();
	}

}


}


?>