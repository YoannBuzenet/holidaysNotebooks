<?php  class User {

	private $id;
	private $email;
	private $nickname;
	private $permission_access;
	private $logged;
	private $userProgress;

	public function getId(){
		return $this->id;
	}

	public function setId(int $id){
		$this->id = $id;
	}

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

	public function getUserProgress(){
		return $this->userProgress;
	}

	public function setUserProgress(array $userProgress){
		$this->userProgress = $userProgress;
	}

	
}



?>