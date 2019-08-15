<?php 


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/c7d097c289.js"></script>
	<link rel="stylesheet" href="public/style/general.css">
	<link rel="stylesheet" href="view/back/styleBack/style.css">
	<title>Template</title>
</head>

<body>
	<header class="back-header">
		<div class="container">
			<a href="index.php?section=logout" class="logout-link"><i class="fas fa-sign-out-alt"></i></a><h1><a href="index.php">Back-office</a></h1>
			<ul>
				<li><a href="index.php">Dashboard</a></li>
				<li><a href="index.php?section=questions&action=1">Questions</a></li>
				<li><a href="index.php?section=courses&action=1">Parcours</a></li>
				<li><a href="index.php?section=users&action=1">Utilisateurs</a></li>
			</ul>
		</div>
	</header>
<?php echo $view;	?>
</body>
</html>