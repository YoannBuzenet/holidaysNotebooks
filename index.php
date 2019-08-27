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
else if($section == "contact-us"){
	include('view/front/fixed_pages/contact-form.php');
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