<?php 

include('model/course/courseManager.php');
//We have to produce a JSON with :
	//- all questions from the course
	//- all SL and Disc from each question
	// each question order for each question
	//So one item will be a question

$result = courseManager::getCourseQuestionsData($bdd, $_GET['id']);

$result = json_encode($result);

echo($result);

?>