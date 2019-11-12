<?php 

//sécurité
//Boucler sur chaque valeur de POST/sortie depuis db pour la HTMLspecialChars;

include_once('tools/db_connect.php');
include_once('model/user/User.php');
include_once('model/user/userManager.php');
include_once('model/course/courseManager.php');

session_start();

//User check
include('controller/user/user.php');

//Catching parameters for browsing the app
//Defining what the user is doing with parameters of by default
if(isset($_GET['section'])){
	$section = $_GET['section'];
}
elseif(isset($_POST['section'])){
	$section = $_POST['section'];
}
else{
	$section = "none";
}


if(isset($_GET['action'])){
	$action = $_GET['action'];
}
elseif(isset($_POST['action'])){
	$action = $_POST['action'];
}
else{
	$action = "1";
}

// Definnig the id we are looking for, is there is one
if(isset($_GET['id'])){
		$id = $_GET['id'];
}
else if(isset($_POST['id'])){
		$id = $_POST['id'];
}		

//Browsing app
if($section == "loginnn"){
	include('view/front/login.php');
}
else if(isset($_POST['user_login'])){
	include('tools/session.php');
}
else if($section == "courses"){
		include('controller/course/course.php');
}
else if($section == "questions"){
	include('controller/question/question.php');
}
else if($section == "ajax"){
	include('controller/ajax/ajax.php');
}
else if($section == "cookie_policy"){
	include('view/front/fixed_pages/cookie_policy.php');
}
else if($section == "privacy_policy"){
	include('view/front/fixed_pages/privacy_policy.php');
}
//landing pages
else if($section == "nos-cahiers-de-vacances-gratuits-pour-les-cm2"){
	$listCourses = courseManager::getAllCourses($bdd);
	include('view/front/fixed_pages/landing_pages/nos-cahiers-de-vacances-gratuits-pour-les-cm2.php');
}
else if($section == "contact-us"){
	//Here we check if the user is sending a message, or if he just did it.
	if(isset($_POST['message'])){
		//mail the message
		mail( 'ybuzenet@gmail.com', $_POST['message-title'], $_POST['message']);

		//display confirmation to user
		$success = true;
		$message = 'Votre message a bien été envoyé.';
	}

	include('view/front/fixed_pages/contact-form.php');
}
else if($section == "legal-mentions"){
	include('view/front/fixed_pages/legal-mentions.php');
}
else if($section == 'logout'){
	session_destroy();
	$listCourses = courseManager::getAllCourses($bdd);
	include('view/front/home.php');
}
else{
	if(userManager::checkIfAdmin($_SESSION['user'])){
		include('controller/user/user_admin.php');
	}
	else{
		$listCourses = courseManager::getAllCourses($bdd);
		include('view/front/home.php');
	}
}


?>