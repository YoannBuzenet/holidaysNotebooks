<?php 

class Course{

	private $id;
	private $name;
	private $number_of_questions;
	private $level;

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

	public function getNumberOfQuestions(){
		return $this->number_of_questions;
	}

	public function setNumberOfQuestions(int $number_of_questions){
		$this->number_of_questions = $number_of_questions;
	}

	public function getLevel(){
		return $this->level;
	}

	public function setLevel(string $level){
		$this->level = $level;
	}

}


?>