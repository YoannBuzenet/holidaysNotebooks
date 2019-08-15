<?php 

class Question {
	private $id;
	private $name;
	private $type;
	private $discipline;
	private $success_rate;

	public function getId(){
		return $this->id;
	}

	public function setId(int $id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName(string $name){
		$this->name = $name;
	}

	public function getType(){
		return $this->type;
	}

	public function setType(string $type){
		$this->type = $type;
	}

	public function getDiscipline(){
		return $this->discipline;
	}

	public function setDiscipline(string $discipline){
		$this->discipline = $discipline;
	}

	public function getSuccessRate(){
		return $this->success_rate;
	}

	public function setSuccessRate(string $success_rate){
		$this->success_rate = $success_rate;
	}

}

?>