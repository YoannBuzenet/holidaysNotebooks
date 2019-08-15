<?php 

session_start();
// Catching parameters
//Defining what the user is doing with parameters of by default
if(isset($_GET['action'])){
	$action = $_GET['action'];
}
elseif(isset($_POST['action'])){
	$action = $_POST['action'];
}
else{
	$action = "read";
}
// Definng the id we are looking for, is there is one
if(isset($_GET['id'])){
		$id = $_GET['id'];
}

//Browsing app when NON LOGGUED
if(!isset($_SESSION['logged_user'])){
	if(isset($_GET['section']) && $_GET['section'] == "loginnn"){
		include('views/front/login.php');
	}
	else if(isset($_POST['user_login'])){
		include('tools/session.php');
	}
	else if(isset($_GET['section']) && $_GET['section'] == "course"){
		include('controller/course/course.php');
	}
	else{
		include('view/front/home.php');
	}
}
//Browing when LOGGED
else if(isset($_SESSION['logged_user'])){
	if(isset($_GET['section']) && $_GET['section'] == "stories"){
		include('controllers/story.php');
	}
	else if(isset($_GET['section']) && $_GET['section'] == 'posters'){
		include('controllers/poster.php');
	}
	else if(isset($_FILES['fileposter'])){
		$action = 'create';
		include('controllers/poster.php');
	}
	else if(isset($_GET['section']) && $_GET['section'] == 'logout'){
		session_destroy();
		include('views/front/homepage.php');
	}
	else{
		include('controllers/story.php');
	}
}


?>