<?php  class User {

	private $email;
	private $nickname;
	private $login;
	private $permission_access;

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getNickname(){
		return $this->nickname;
	}

	public function setNickname($nickname){
		$this->nickname = $nickname;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setEmail($login){
		$this->login = $login;
	}

	public function getPermission_access(){
		return $this->permission_access;
	}

	public function setPermission_access($permission_access){
		$this->permission_access = $permission_access;
	}

	
}



?>