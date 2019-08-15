<?php 

include('model/course/courseManager.php');

if(userManager::checkIfAdmin($_SESSION['user'])){

	switch($action){

		case "1":
		$listCourses = courseManager::getAllCourses($bdd);
		include('view/back/course/all_courses.php');
	}
}
else{
	include('view/front/course/course.php');
}

?>