<?php 

include('model/question/questionManager.php');

if(isset($_POST['id_discipline'])){
	$id_discipline = $_POST['id_discipline'];
}
else {
	$id_discipline=8;
}
if(isset($_POST['id_school_level'])){
	$id_school_level = $_POST['id_school_level'];
}
else{
	$id_school_level = 4;
}

//echo $id_school_level;
//echo $id_discipline;

$listeOfQuestionFiltered = questionManager::getQuestionsWithIdDisciplineAndIdSchoolLevel($bdd, $id_discipline, $id_school_level);

//ICI il faut GET la liste des questions correspondant aux critères en mettant leur global ID dans la value des options

$json_listeOfQuestionFiltered = json_encode($listeOfQuestionFiltered);
echo $json_listeOfQuestionFiltered;

?>