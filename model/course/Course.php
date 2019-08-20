<?php 

class Course{

	private $id;
	private $name;
	private $number_of_questions;
	private $id_school_level;
	private $url_picture;

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
		return $this->id_school_level;
	}

	public function setLevel(string $id_school_level){
		$this->id_school_level = $id_school_level;
	}

	public function getUrlPicture(){
		return $this->url_picture;
	}

	public function setUrlPicture(string $url_picture){
		$this->url_picture = $url_picture;
	}

}


?>