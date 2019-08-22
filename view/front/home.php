<?php ob_start(); 

//var_dump($listCourses);
?>

<div class="cards-container">

<?php 
foreach($listCourses as $course){ ?>

	<a href="index.php?section=courses&action=3&id=<?= $course['id'] ?>" class="card-link">
		<article class="card">
			<img src="<?= $course['url_picture'] ?>" class="card-img">
			<h1><?= $course['slname'] ?> - <?= $course['general_level'] ?> </h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	
<?php } ?>

<?php 
$view = ob_get_clean();
include('view/front/templateFront.php');
?>