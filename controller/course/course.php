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
			//Course validation after creation
			$success = courseManager::registerCourse($bdd, $_POST, $_FILES["course-picture"]);

			$listCourses = courseManager::getAllCourses($bdd);
			$message = "Le parcours a bien été créé.";
			include('view/back/course/all_courses.php');
		break;

		case "3":
			//Updating a course 
			$current_course = courseManager::findCourseById($bdd, $id);

			$listDisciplines = questionManager::getAllDisciplines($bdd);
			$listeSchoolLevel = questionManager::getAllSchoolLevel($bdd);
			include('view/back/course/update.php');
		break;


		case "3V":

		break;

	}
}
else{
	include('view/front/course/course.php');
}

?>