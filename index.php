<?php 

include_once('tools/db_connect.php');
include_once('model/user/User.php');
include_once('model/user/userManager.php');

session_start();

//Builing User to browse the app
if(!isset($_SESSION['user'])){

	$user = New User;
	$user->setLogged(false);
	$_SESSION['user'] = $user;
}


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

//Browsing app
if(isset($_GET['section']) && $_GET['section'] == "loginnn"){
	include('view/front/login.php');
}
else if(isset($_POST['user_login'])){
	include('tools/session.php');
}
else if(isset($_GET['section']) && $_GET['section'] == "courses"){
	include('controller/course/course.php');
}
else if(isset($_GET['section']) && $_GET['section'] == "questions"){
	include('controller/question/question.php');
}
else if(isset($_POST['section']) && $_POST['section'] == "questions"){
	include('controller/question/question.php');
}
else if(isset($_GET['section']) && $_GET['section'] == 'logout'){
	session_destroy();
	include('view/front/home.php');
}
else{
	if(userManager::checkIfAdmin($_SESSION['user'])){
		include('controller/user/user_admin.php');
	}
	else{
		include('view/front/home.php');
	}
}


?>