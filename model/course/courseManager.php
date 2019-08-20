<?php 

include('model/course/Course.php');

class CourseManager{


public static function getAllCourses($pdo){

	$sql = "SELECT (SELECT COUNT(id_question) FROM course_questions WHERE id_course=c.id) as total_questions, c.id, c.name, c.id_school_level, sl.school_level as slname 
			FROM courses c
			INNER JOIN school_levels sl ON c.id_school_level = sl.id
			ORDER BY c.id";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->execute();

	return $pdoStatement->fetchAll();
}

public static function registerCourse(PDO $pdo, $post, $file){

	//var_dump($post);


	//Saving the picture
	$target_dir = "public/pictures/courses/";
	$target_file = $target_dir . basename($file["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// if everything is ok, try to upload file
	move_uploaded_file($_FILES["course-picture"]["tmp_name"], $target_file); 

	//insert into bdd
	$course_name = $_POST['course-name'];
	$course_level = $_POST['course-level'];

	$sql = "INSERT INTO courses(name, id_school_level, url_picture) VALUES (?,?,?)";

	$pdoStatement = $pdo->prepare($sql);

	$pdoStatement->bindParam(1, $course_name, PDO::PARAM_STR);
	$pdoStatement->bindParam(2, $course_level, PDO::PARAM_INT);
	$pdoStatement->bindParam(3, $target_file, PDO::PARAM_STR);
	$pdoStatement->execute();

	//get the most recent course and take the id
	$sql = "SELECT * FROM courses ORDER BY id DESC LIMIT 1";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->execute();
	$result = $pdoStatement->fetch();

	$id = $result['id'];
	$id = intval($id);


	//us the id to save the intermediary table
	// We browse the $_POST to extract the key/value of question ID.
	$questions_orders = array();
	
	foreach ($post as $key => $value) {
		if(preg_match('#^order#', $key)){
			$order_question = intval($value);
			$order_found = true;
		}

		if(preg_match('#^question#', $key)){
			$id_question = intval($value);
			$question_found = true;
		}
		if(isset($order_found) && $order_found && isset($question_found) && $question_found){
			$questions_orders[$order_question] = $id_question;
			$order_found = false;
			$question_found = false;
		}
	}


	foreach ($questions_orders as $order => $question) {
		$sql = "INSERT INTO course_questions(order_question, id_question, id_course) VALUES (?,?,?)";

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindParam(1, $order, PDO::PARAM_INT);
		$pdoStatement->bindParam(2, $question, PDO::PARAM_INT);
		$pdoStatement->bindParam(3, $id, PDO::PARAM_INT);
		$pdoStatement->execute();

		return $pdoStatement->rowCount();
	}

}
//Get the basic information about a course (id, name, url picture, school level)
public static function findCourseById(PDO $pdo, int $id){

	$sql = "SELECT * FROM courses WHERE id=?";

	$pdoStatement = $pdo->prepare($sql);

	$pdoStatement->bindParam(1, $id, PDO::PARAM_INT);
	$pdoStatement->execute();

	return $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Course");


}

//Get all datas about questions in a course
public static function getCourseQuestionsData(PDO $pdo, int $id){
	
	$sql = "SELECT q.id, qtr.name, d.id, d.discipline, sl.id, sl.school_level, cq.order_question, c.name
			FROM courses c
			INNER JOIN course_questions cq ON c.id = cq.id_course
			INNER JOIN questions q ON cq.id_question = q.id
			INNER JOIN questions_type_radio qtr ON q.id = qtr.global_id
			INNER JOIN school_levels sl ON qtr.id_school_level = sl.id
			INNER JOIN disciplines d ON qtr.id_discipline = d.id
			WHERE c.id=?";

	$pdoStatement = $pdo->prepare($sql);

	$pdoStatement->bindParam(1, $id, PDO::PARAM_INT);
	$pdoStatement->execute();

	return $pdoStatement->fetchAll();		

}	

}


?>