<?php 

include('model/question/questionManager.php');

$listofDisciplines = questionManager::getAllDisciplines($bdd);

$json_listofDisciplines = json_encode($listofDisciplines);

echo $json_listofDisciplines;


?>