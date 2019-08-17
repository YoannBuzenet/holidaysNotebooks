<?php 
ob_start();
?>
<div class="container">
	<h2>Créer un parcours</h2>
	<div class="form-container">
		<form action="index.php" method="POST" class="create-form">

			<label for="course-name">Nom du parcours</label>
			<input type="text" id="course-name">
			
			<div class="course-question-add" id="course-question-add">
				<p id=button-add><i class="fas fa-plus-circle"></i> Ajouter une question</p>
			</div>

			<input type="hidden" name="action" value="2V">
			<input type="hidden" name="section" value="course">
			<input type="submit" value ="Créer le parcours">
		</form>
	</div>	

</div>
<script src="view/back/jsBack/course.js"></script>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>