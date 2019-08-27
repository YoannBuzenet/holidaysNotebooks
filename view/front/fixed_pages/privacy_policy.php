<?php 

ob_start();

//var_dump($course);
?>
<h1>Politique de vie privée</h1>

<p>Liste des données conservées par le www.cahier-de-vacances, dit le site :</p>

<ul>
	<li>Taux de succès par question</li>
	<li>Taux de succès par cahier de vacance</li>
	<li>Les dates auxquelles les questions et les cahiers ont été passés.</li>
</ul>

<p>Ces données sont <strong>complètement anonymisées</strong> et nous servent à améliorer la pertinence des cahiers proposés : </p>
<ul>
	<li>Voir si des questions sont plus difficiles que d'autres</li>
	<li>Voir si les utilisateurs bloquent tous à la même question</li>
	<li>Voir si les parcours sont plus ou moins utilisés à telle période de l'année.</li>
</ul>

<p>En cas de question, merci de nous contacter via le <a href="index.php?section=contact-us">formulaire de contact</a>.</p>

<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>