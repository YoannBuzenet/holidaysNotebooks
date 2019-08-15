<?php 

if(userManager::checkIfAdmin($_SESSION['user'])){
	include('view/back/course/all_courses.php');
}
else{
	include('view/front/course/course.php');
}

?>