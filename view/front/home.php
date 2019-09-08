<?php ob_start(); 

//var_dump($listCourses);
?>

<div class="cards-container">
	<p>Bienvenue sur les cahiers de vacances ! Sur le site vous trouverez des cahiers de vacances en ligne gratuits à destination des enfants. Leur progression est sauvegardée automatiquement, vous pouvez quitter le site, revenir et continuer votre cahier. </p> <p>Idéal pour les révisions. Notre conseil : 5 questions par jour !</p>


	<h1>Découvrez nos cahiers de vacances en ligne</h1>
<?php 
foreach($listCourses as $course){ ?>

	<a href="index.php?section=courses&action=3&id=<?= $course['id'] ?>" class="card-link">
		<article class="card">
			<img src="<?= $course['url_picture'] ?>" class="card-img">
			<div class="course-infos">
				<h1><?= $course['slname'] ?> - <?= $course['general_level'] ?> </h1>
				<h2><?= $course['name'] ?></h2>
			</div>

			<p class="discover">Découvrez</p>
		</article>
	</a>
	
<?php } ?>


<?php 
$view = ob_get_clean();
include('view/front/templateFront.php');
?>