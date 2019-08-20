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
else if($section == 'logout'){
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