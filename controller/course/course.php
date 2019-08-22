<?php 

include_once('model/course/courseManager.php');
include_once('model/question/questionManager.php');

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
			//Saving the modified course
			courseManager::updateCourse($bdd, $_POST);

			//If there's a new file, we register it AND update its link on DB
			if(isset($_FILES["course-picture"])){
				courseManager::updatePictureCourse($bdd, $_POST['id'], $_FILES["course-picture"]);
			}

			$listCourses = courseManager::getAllCourses($bdd);
			$message = "Le parcours a bien été modifié.";
			include('view/back/course/all_courses.php');

		break;

	}
}
else{
	switch($action){

		case "1":
		//display all courses

		$listCourses = courseManager::getAllCourses($bdd);
		include('view/front/home.php');
		break;

		case "2":
		//display all courses with particular school level OR discipline

		include('view/front/course/course.php');
		break;

		case "3":
		//Begin the course !
		$course_id = $_GET['id'];

		if(isset($_POST['current_question'])){
			$next_question_id = $_POST['current_question'];
		}
		else {
			$next_question_id = 0;
		}

		//get the following question
		$next_question = questionManager::getNextQuestion($bdd, $course_id, $next_question_id);

		//Do a particular course
		//load a particular question

		include('view/front/course/course.php');
		break;
	}
}

?>