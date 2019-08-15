<?php ob_start() ?>

<div class="cards-container">
	<a href="index.php?section=course&class=3eme" class="card-link">
		<article class="card">
			<h1>3ème - College</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	<a href="#" class="card-link">
		<article class="card">
			<h1>4ème - College</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	<a href="#" class="card-link">
		<article class="card">
			<h1>5ème - College</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	<a href="#" class="card-link">
		<article class="card">
			<h1>6ème - College</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	<a href="#" class="card-link">
		<article class="card">
			<h1>CM2 - Primaire</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	<a href="#" class="card-link">
		<article class="card">
			<h1>CM1 - Primaire</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	<a href="#" class="card-link">
		<article class="card">
			<h1>CE2 - Primaire</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	<a href="#" class="card-link">
		<article class="card">
			<h1>CE1 - Primaire</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
	<a href="#" class="card-link">
		<article class="card">
			<h1>CP - Primaire</h1>
			<p class="discover">Découvrez</p>
		</article>
	</a>
</div>	

<?php 
$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>