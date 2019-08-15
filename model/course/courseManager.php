<?php 

include('model/course/Course.php');

class CourseManager{


public static function getAllCourses($pdo){

	$sql = "SELECT * FROM courses ORDER BY id";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->execute();

	return $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Course");
}

//add a question
//remove a question

}


?>