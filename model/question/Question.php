<?php 

class Question {
	private $id;
	private $name;
	private $type;
	private $discipline;
	private $school_level;
	private $success_rate;
	private $enonce;
	private $question1;
	private $question2;
	private $question3;
	private $question4;
	private $soluce;
	

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

	public function getSchoolLevel(){
		return $this->school_level;
	}

	public function setSchoolLevel(string $school_level){
		$this->school_level = $school_level;
	}

	public function setSuccessRate(string $success_rate){
		$this->success_rate = $success_rate;
	}

	public function getSuccessRate(){
		return $this->success_rate;
	}

	public function setEnonce(string $enonce){
		$this->enonce = $enonce;
	}

	public function getEnonce(){
		return $this->enonce;
	}

	public function setAnswer1(string $answer1){
		$this->answer1 = $answer1;
	}

	public function getAnswer1(){
		return $this->answer1;
	}

	public function setAnswer2(string $answer2){
		$this->answer2 = $answer2;
	}

	public function getAnswer2(){
		return $this->answer2;
	}

	public function setAnswer3(string $answer3){
		$this->answer3 = $answer3;
	}

	public function getAnswer3(){
		return $this->answer3;
	}

	public function setAnswer4(string $answer4){
		$this->answer4 = $answer4;
	}

	public function getAnswer4(){
		return $this->answer4;
	}

	public function setSoluce(string $soluce){
		$this->soluce = $soluce;
	}

	public function getSoluce(){
		return $this->soluce;
	}

}

?>