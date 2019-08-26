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
			if(isset($_FILES["course-picture"]) && !empty($_FILES['course-picture']['name'][0])){
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
			$current_course = courseManager::findCourseById($bdd, $course_id);

			//If we received a POST, that means the course has begun. We look for the next page, or the end of the course.
			// Each time, we check what's in the user memory about the course, to be sure he continues where he stopped before.
			if(isset($_POST['next_question'])){
				//Checking if the course is over
				if(intval($_POST['next_question']) == $current_course->total_questions){

					userManager::updateUserProgress($bdd, $_SESSION['user'], $current_course->total_questions, $course_id);
					userManager::trackResult($bdd, $_SESSION['user'], $_POST['result'], $course_id, $_POST['question-id']);
					//calculer résultat de bonne rep ici
					$course = courseManager::findCourseById($bdd, $course_id);
					$final_score = courseManager::calculateSuccessRateOnCourse($bdd, $_SESSION['user'], $course_id);

					//End of course : result page
					include('view/front/course/endcourse.php');
					exit;
				}
				else{
					//controlling that the question is not already done by the user (ie its number order has to be greater that what's in memory)
					if(!empty($_SESSION['user']->getUserProgress())){
						$user_progress = $_SESSION['user']->getUserProgress();
						if(array_key_exists($course_id, $user_progress)){
							//If the input tries to go backward or forward in the course, we stick it to the regular path.
							if(intval($_POST['next_question']) <= intval($user_progress[$course_id]) || intval($_POST['next_question']) > intval($user_progress[$course_id])+1){
								$next_question_id = $user_progress[$course_id]+1;
							}
							//If it's the normal number going, we follow it
							else{
								$next_question_id = $_POST['next_question'];
								//update user progress HERE
								userManager::updateUserProgress($bdd, $_SESSION['user'], $next_question_id, $course_id);
								userManager::trackResult($bdd, $_SESSION['user'], $_POST['result'], $course_id, $_POST['question-id']);
							}
						}
						else{
								$next_question_id = $_POST['next_question'];
								//update user progress HERE
								userManager::updateUserProgress($bdd, $_SESSION['user'], $next_question_id, $course_id);
								userManager::trackResult($bdd, $_SESSION['user'], $_POST['result'], $course_id, $_POST['question-id']);
							}

					}
					else{
						//If nothing is in memory, we set the next question number
						//This path is possible if user has memory but not for the current course
						$next_question_id = $_POST['next_question'];

						//update user progress HERE
						userManager::updateUserProgress($bdd, $_SESSION['user'], $next_question_id, $course_id);
						userManager::trackResult($bdd, $_SESSION['user'], $_POST['result'], $course_id, $_POST['question-id']);
					}
					
				}
				
			}
			//If there are no POST datas
			else {
			//Here we check the cookie if relevant data concerning this course are there
				if(!empty($_SESSION['user']->getUserProgress())){
					$user_progress = $_SESSION['user']->getUserProgress();

					if(array_key_exists($course_id, $user_progress)){
						$next_question_id = $user_progress[$course_id];

						if($user_progress[$course_id] == $current_course->total_questions){
							$course = courseManager::findCourseById($bdd, $course_id);
							$final_score = courseManager::calculateSuccessRateOnCourse($bdd, $_SESSION['user'], $course_id);
							include('view/front/course/endcourse.php');
							exit;
						}
					}
					else{
						//If we have no info, we take the first question in the course (the number 0)
						$next_question_id = 0;
					}
				}
				else{
						//If we have no info, we take the first question in the course (the number 0)
						$next_question_id = 0;

					}
				
			}	


			//get the following question
			$next_question = questionManager::getNextQuestion($bdd, $course_id, $next_question_id);

			//get the course info
			$course = courseManager::findCourseById($bdd, $course_id);
			include('view/front/course/course.php');
		break;

		case "4":

		$course_id = $_GET['id'];

		//Restart user course
		userManager::updateUserProgress($bdd, $_SESSION['user'], '0', $course_id);

		header('location:index.php?section=courses&action=3&id='.$course_id);

	}
}

?>