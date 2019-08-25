<?php 

ob_start();

//var_dump($course);
?>

<article class="endcourse">
	<p class="course-title"><?= $course->school_level ?> - <?= $course->general_level ?></p>

	<div class="progress-wrapper">
		<progress value="1" max="1">100%</progress>
	</div>
	<p class="checked">CAHIER TERMINÉ &#10004;</p>

	<h2>Félicitations ! Tu as terminé ce cahier de vacances !</h2>
	<p>Ton score total est de 72%.</p>
	<p>Voici le rappel des questions où tu t'es trompé·e :</p>

	<p>N'hésite pas à reprendre le cahier quand tu veux !</p>
	<p>Recommencer le cahier</p>
</article>
				


<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>