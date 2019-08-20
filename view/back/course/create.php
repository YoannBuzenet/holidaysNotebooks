<?php 
ob_start();
?>
<div class="container">
	<h2>Créer un parcours</h2>
	<div class="form-container">
		<form action="index.php" method="POST" class="create-form" id="course-form" enctype="multipart/form-data">

			<label for="course-name">Nom du parcours</label>
			<input type="text" id="course-name" name="course-name" required>

			<input type="file" id="course-picture" name="course-picture" class="inputfile" accept="image/png, image/jpeg" required>
			<label for="course-picture"><i class="fas fa-plus-circle"></i> Ajouter une image</label>
			
			<div class="course-question-add" id="course-question-add">
				<p id=button-add><i class="fas fa-plus-circle"></i> Ajouter une question</p>
			</div>

			<input type="hidden" name="action" value="2V">
			<input type="hidden" name="section" value="courses">
			<input type="submit" id="create-course-button" value ="Créer le parcours">
		</form>
	</div>	

</div>
<script src="view/back/jsBack/Question.js"></script>
<script src="view/back/jsBack/course.js"></script>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>