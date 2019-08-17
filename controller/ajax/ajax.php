<?php 

if(isset($_GET['page'])){
	$page = $_GET['page'];
}
elseif(isset($_POST['page'])){
	$page = $_POST['page'];
}
else{
	$page = "discipline";
}


switch($page){

	case"discipline":

	include('src/ajax/get_disciplines.php');
	break;

	case"get_school_level":

	include('src/ajax/get_school_level.php');
	break;

	case"ask":

	include('src/ajax/ask.php');
	break;	

	case"post":

	include('src/ajax/post.php');
	break;

}


?>