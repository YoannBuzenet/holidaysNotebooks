<?php 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="public/style/general.css">
	<link rel="stylesheet" href="public/style/homepage.css">
	<link rel="stylesheet" href="public/style/parcours.css">
	<title>Template</title>
</head>

<body>
	<div class="main-container">
		<div class="left-content">

		</div>	
		<div class="main-content">
			<header class="main-header">
				<div class="container">
					<h1><a href="/holidaysNotebooks">Cahiers de vacances gratuits</a></h1>
				</div>
				<div class="menu">
					<ul>
						<li><a href="#">Primaire</a></li>
						<li><a href="#">Collège</a></li>
					</ul>
				</div>	
			</header>
			<div class="container">
				<main>
 
					<?php echo $view; ?>

				</main>
			</div>
		</div>
		<div class="right-content">
			
		</div>
	</div>
	<footer>
		<ul>
			<li><a href="#">A propos</a></li>
			<li><a href="#">Contactez-nous</a></li>
			<li><a href="#">Politique de confidentialité</a></li>
			<li><a href="#">Mentions légales</a></li>
		</ul>
	</footer>
</body>
</html>