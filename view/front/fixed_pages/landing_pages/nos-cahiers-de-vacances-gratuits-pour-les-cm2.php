<?php 

ob_start();
//var_dump($listCourses);
?>

<h1>Nos cahiers de vacances gratuits pour les CM2</h1>

<p>Découvrez nos cahiers de vacances gratuits en ligne pour les CM2. Ils suivent le programme officiel de l'école.</p>

<?php 
foreach($listCourses as $course){
    if($course['slname'] == 'CM2' && $course['name'] == 'Français'){ ?>

    <h2>Notre cahier de français en CM2 :</h2>

    <a href="index.php?section=courses&action=3&id=<?= $course['id'] ?>" class="card-link">
    <article class="card center-card">
			<img src="<?= $course['url_picture'] ?>" class="card-img">
			<div class="course-infos">
				<h1><?= $course['slname'] ?> - <?= $course['general_level'] ?> </h1>
				<h2><?= $course['name'] ?></h2>
			</div>

			<p class="discover">Découvrez</p>
		</article>
    </a>    
    <?php }


} ?>

<?php 
foreach($listCourses as $course){
    if($course['slname'] == 'CM2' && $course['name'] == 'Mathématiques'){ ?>

    <h2>Notre cahier de mathématiques en CM2 :</h2>

    <a href="index.php?section=courses&action=3&id=<?= $course['id'] ?>" class="card-link">
        <article class="card center-card">
			<img src="<?= $course['url_picture'] ?>" class="card-img">
			<div class="course-infos">
				<h1><?= $course['slname'] ?> - <?= $course['general_level'] ?> </h1>
				<h2><?= $course['name'] ?></h2>
			</div>

			<p class="discover">Découvrez</p>
		</article>
    </a>  
    <?php }
    

} ?>

<p class="margin-bottom-paragraph">Vous aimeriez voir d'autres matières sur le site ? Ou d'autres classes ? <a href="index.php?section=contact-us">Contactez-nous</a> !</p>



<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>