<?php 
ob_start();
?>
<div class="container">
	<h2>Modifier un parcours</h2>
	<div class="form-container">
		<form action="index.php" method="POST" class="create-form" id="course-form" enctype="multipart/form-data">

			<label for="course-name">Nom du parcours</label>
			<input type="text" id="course-name" name="course-name" required>

			<label for="course-level">Niveau du parcours</label>
			<select name="course-level" id="course-level">
				<option value="default" disabled checked>Niveau scolaire</option>
			<?php foreach($listeSchoolLevel as $school_level){?>
				<option value="<?= $school_level['id'] ?>"><?= $school_level['school_level'] ?></option>
			<?php } ?>
			</select>
			
			<input type="file" id="course-picture" name="course-picture" class="inputfile" accept="image/png, image/jpeg">
			<label for="course-picture" class="add-picture"><i class="fas fa-plus-circle"></i> Modifier l'image</label>
			
			<div class="course-question-add" id="course-question-add">
				<p id=button-add><i class="fas fa-plus-circle"></i> Ajouter une question</p>
			</div>

			<input type="hidden" name="action" value="3V">
			<input type="hidden" name="section" value="courses">
			<input type="submit" id="create-course-button" value ="Modifier le parcours">
		</form>
	</div>	

</div>
<script src="view/back/jsBack/Question.js"></script>
<script src="view/back/jsBack/course.js"></script>
<script src="view/back/jsBack/courseEdit.js"></script>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>