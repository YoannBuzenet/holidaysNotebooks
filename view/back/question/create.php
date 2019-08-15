<?php 
ob_start();
?>
<div class="container">
	<h2>Créer une question</h2>
	<div class="form-container">
		<form action="index.php" method="POST" class="create-form">

			
			<label for="name">Name</label><input type="text" id="name">
			<select name="question-type" id=""question-type>
				<?php foreach($list_of_types as $type){?>
				<option value="<?= $type[1] ?>"><?= $type[1] ?></option>
				<?php }  ?>
			</select>

			<select name="question-discipline" id="question-discipline">
				<?php foreach($list_of_disciplines as $discipline){?>
				<option value="<?= $discipline[1] ?>"><?= $discipline[1] ?></option>
				<?php }  ?>
			</select>

			<select name="question-school_level" id="question-school_level">
				<?php foreach($list_of_school_level as $school_level){?>
				<option value="<?= $school_level[1] ?>"><?= $school_level[1] ?></option>
				<?php }  ?>
			</select>

			
			<textarea name="answer1" id="answer1" cols="30" rows="10" placeholder="Réponse 1"></textarea>
			<textarea name="answer2" id="answer2" cols="30" rows="10" placeholder="Réponse 2"></textarea>
			<textarea name="answer3" id="answer3" cols="30" rows="10" placeholder="Réponse 3"></textarea>
			<textarea name="answer4" id="answer4" cols="30" rows="10" placeholder="Réponse 4"></textarea>
			<textarea name="soluce" id="soluce" cols="30" rows="10" placeholder="Solution"></textarea>
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