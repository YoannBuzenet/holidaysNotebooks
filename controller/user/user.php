<?php 

//Building User to browse the app
if(!isset($_SESSION['user'])){

	$user = New User;
	$user->setLogged(false);
	$_SESSION['user'] = $user;
}

//ONCE PER SESSION
if(!isset($_SESSION['cookie_control'])){
	//COOKIE CONTROL
	//we charge user's profile thanks to its cookie ID if he has one ; otherwise, we create a cookie ID both on its browser and in DB.
	if(isset($_COOKIE['cookie_id'])){
		$cookie_id = htmlentities($_COOKIE['cookie_id']);

		//getting User ID
		$result = userManager::getUserIDWithCookieID($bdd, $cookie_id);
		$user_id = $result[0];
		$_SESSION['user']->setId($user_id);

		//hydrating Session with user info
		$user_progress = userManager::getUserProgress($bdd, $_SESSION['user']->getId());
		$_SESSION['user']->setUserProgress($user_progress);

		//var_dump($_SESSION['user']);

	}
	else{
		//Defining cookie
		$cookie_id = session_id().time();
		setcookie('cookie_id', $cookie_id, time() + 92*24*3600, null, null, false, true);

		//registering cookie in DB
		$success = userManager::registerCookieInDB($bdd, $cookie_id);
		//var_dump($success);

		//getting User ID
		$result = userManager::getUserIDWithCookieID($bdd, $cookie_id);
		$user_id = $result[0];
		$_SESSION['user']->setId($user_id);

	}

	$_SESSION['cookie_control'] = true;
}

?>