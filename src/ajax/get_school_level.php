<?php 

include('model/question/questionManager.php');

$listofschool_level = questionManager::getAllSchoolLevel($bdd);

$json_listOfSchoolLevel = json_encode($listofschool_level);

echo $json_listOfSchoolLevel;

?>