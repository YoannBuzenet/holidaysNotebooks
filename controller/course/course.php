<?php 

include('model/course/courseManager.php');
include('model/question/questionManager.php');

if(userManager::checkIfAdmin($_SESSION['user'])){

	switch($action){

		case "1":
			//Reading all courses
			$listCourses = courseManager::getAllCourses($bdd);
			include('view/back/course/all_courses.php');
		break;

		case "2":
			//Creating a course
			$listeSchoolLevel = questionManager::getAllSchoolLevel($bdd);
			$listDisciplines = questionManager::getAllDisciplines($bdd);
			include('view/back/course/create.php');
		break;

		case "2V":
			var_dump($_POST);
			//Course validation after creation
			courseManager::registerCourse($bdd, $_POST, $_FILES["course-picture"]);
		break;

	}
}
else{
	include('view/front/course/course.php');
}

?>