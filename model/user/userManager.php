<?php 

include_once('model/user/User.php');

class UserManager {

	//CRUD User to do

	public static function checkIfAdmin(User $user){
		if($user->getPermission_access() == 'admin'){
			return true;
		}
		else{
			return false;
		}
		
	}

	public static function checkIfLogged(User $user){

		if($user->logged == 'logged'){
			return true;
		}
		else{
			return false;
		}
		
	}
	
	
}

?>