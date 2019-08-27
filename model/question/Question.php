<?php 

class Question {
	private $id;
	private $name;
	private $type;
	private $id_type;
	private $discipline;
	private $id_discipline;
	private $school_level;
	private $id_school_level;
	private $success_rate;
	private $enonce;
	private $answer1;
	private $answer2;
	private $answer3;
	private $answer4;
	private $solution;
	private $solution_number;
	private $global_id;
	private $order_number;
	private $total_questions;
	private $questionPicture;
	private $questionSolutionPicture;
	private $url_picture_main;
	

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

	public function getIdType(){
		return $this->id_type;
	}

	public function setIdType(int $id_type){
		$this->id_type = $id_type;
	}

	public function getDiscipline(){
		return $this->discipline;
	}

	public function setDiscipline(string $discipline){
		$this->discipline = $discipline;
	}

	public function getIdDiscipline(){
		return $this->id_discipline;
	}

	public function setIdDiscipline(string $id_discipline){
		$this->id_discipline = $id_discipline;
	}

	public function getSchoolLevel(){
		return $this->school_level;
	}

	public function setSchoolLevel(string $school_level){
		$this->school_level = $school_level;
	}

	public function getIdSchoolLevel(){
		return $this->id_school_level;
	}

	public function setIdSchoolLevel(string $id_school_level){
		$this->id_school_level = $id_school_level;
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

	public function setSoluce(string $solution){
		$this->solution = $solution;
	}

	public function getSoluce(){
		return $this->solution;
	}

	public function setSolutionNumber(int $solution_number){
		$this->solution_number = $solution_number;
	}

	public function getSolutionNumber(){
		return $this->solution_number;
	}

	public function setGlobalId(int $global_id){
		$this->global_id = $global_id;
	}

	public function getGlobalId(){
		return $this->global_id;
	}

	public function setOrderNumber(int $order_number){
		$this->order_number = $order_number;
	}

	public function getOrderNumber(){
		return $this->order_number;
	}

	public function setTotalQuestions(int $total_questions){
		$this->total_questions = $total_questions;
	}

	public function getTotalQuestions(){
		return $this->total_questions;
	}

	public function setQuestionPicture($file){
		$this->questionPicture = $file;
	}

	public function getQuestionPicture(){
		return $this->questionPicture;
	}

	public function setQuestionSolutionPicture($file){
		$this->questionSolutionPicture = $file;
	}

	public function getQuestionSolutionPicture(){
		return $this->questionSolutionPicture;
	}

	public function setURLPictureMain($url_picture_main){
		$this->url_picture_main = $url_picture_main;
	}

	public function getURLPictureMain(){
		return $this->url_picture_main;
	}

}

?>