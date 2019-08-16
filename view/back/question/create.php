<?php 
ob_start();
?>
<div class="container">
	<h2>Créer une question</h2>
	<div class="form-container">
		<form action="index.php" method="POST" class="create-form">

			
			<label for="name">Nom de la question</label><input type="text" id="name" name="name" required>
			<div class="form-select">
				<select name="question-type" id="question-type">
					<option value="type-de-question" selected disabled>Type de question</option>
					<?php foreach($list_of_types as $type){?>
					<option value="<?= $type['id'] ?>"><?= $type[1] ?></option>
					<?php }  ?>
				</select>

				<select name="question-discipline" id="question-discipline">
					<option value="discipline" selected disabled>Discipline</option>
					<?php foreach($list_of_disciplines as $discipline){?>
					<option value="<?= $discipline['id'] ?>"><?= $discipline[1] ?></option>
					<?php }  ?>
				</select>

				<select name="question-school_level" id="question-school_level">
					<option value="school_level" selected disabled>Niveau scolaire</option>
					<?php foreach($list_of_school_level as $school_level){?>
					<option value="<?= $school_level['id'] ?>"><?= $school_level[1] ?></option>
					<?php }  ?>
				</select>
			</div>
			<textarea name="enonce" id="enonce" cols="60" rows="10" placeholder="Enonce" required></textarea>
			<textarea name="answer1" id="answer1" cols="60" rows="10" placeholder="Réponse 1" required></textarea>
			<textarea name="answer2" id="answer2" cols="60" rows="10" placeholder="Réponse 2" required></textarea>
			<textarea name="answer3" id="answer3" cols="60" rows="10" placeholder="Réponse 3" required></textarea>
			<textarea name="answer4" id="answer4" cols="60" rows="10" placeholder="Réponse 4" required></textarea>
			<textarea name="soluce" id="soluce" cols="60" rows="10" placeholder="Solution" required></textarea>
			<input type="hidden" name="action" value="2V">
			<input type="hidden" name="section" value="questions">
			<input type="submit" value ="Créer">
		</form>
	</div>	

</div>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>