<?php 

include('model/question/questionManager.php');

$id_question = $_GET['idq'];

$solution = questionManager::getSolution($bdd, $id_question);

$solution = json_encode($solution);

echo $solution;

?>