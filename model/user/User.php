<?php  class User {

	private $email;
	private $nickname;
	private $permission_access;
	private $logged;

	public function getEmail(){
		return $this->email;
	}

	public function setEmail(string $email){
		$this->email = $email;
	}

	public function getNickname(){
		return $this->nickname;
	}

	public function setNickname(string $nickname){
		$this->nickname = $nickname;
	}

	public function getLogged(){
		return $this->logged;
	}

	public function setLogged(bool $logged){
		$this->logged = $logged;
	}

	public function getPermission_access(){
		return $this->permission_access;
	}

	public function setPermission_access(string $permission_access){
		$this->permission_access = $permission_access;
	}

	
}



?>