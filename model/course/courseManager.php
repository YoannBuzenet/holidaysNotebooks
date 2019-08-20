<?php 

include('model/course/Course.php');

class CourseManager{


public static function getAllCourses($pdo){

	$sql = "SELECT * FROM courses ORDER BY id";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->execute();

	return $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Course");
}

public static function registerCourseWithJSON(PDO $pdo, string $json){

			$json = json_decode($json);

			$course_name = $json[0];
			echo $json[0];

			//CREER LE PARCOURS EN BASE

			foreach ($json[1] as $question) {
				echo $question->order;
				echo $question->globalId;
			}

			//ENREGISTRER TOUTES LES ASSOCIATIONS DANS LA TABLE INTERMEDIAIRE AVEC L ID

			echo'bien reçu';
}


public static function registerPictureCourse(PDO $pdo, $file){

	$target_dir = "public/pictures/courses/";
	$target_file = $target_dir . basename($file["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// if everything is ok, try to upload file
	move_uploaded_file($_FILES["course-picture"]["tmp_name"], $target_file); 

}

}


?>