<?php 
ob_start();
?>
<div class="container">
	<h2>Modifier une question</h2>

	<div class="form-container">
		<form action="index.php" method="POST" class="create-form" enctype="multipart/form-data">

			
			<label for="name">Nom de la question</label><input type="text" id="name" name="name" value="<?= $question_to_edit->getName() ?>"required>
			<div class="form-select">
				<select name="question-type" id="question-type">
					<option value="type-de-question" disabled>Type de question</option>
					<?php foreach($list_of_types as $type){?>
					<option value="<?= $type['id'] ?>" <?= ($type['id'] == $question_to_edit->getIdType()) ? 'selected' : null ?>><?= $type[1] ?></option>
					<?php } ?>
				</select>

				<select name="question-discipline" id="question-discipline">
					<option value="discipline" disabled>Discipline</option>
					<?php foreach($list_of_disciplines as $discipline){?>
					<option value="<?= $discipline['id'] ?>" <?= ($discipline['id'] == $question_to_edit->getIdDiscipline()) ? 'selected' : null ?>><?= $discipline[1] ?></option>
					<?php }  ?>
				</select>

				<select name="question-school_level" id="question-school_level">
					<option value="school_level" disabled>Niveau scolaire</option>
					<?php foreach($list_of_school_level as $school_level){?>
					<option value="<?= $school_level['id'] ?>"<?= ($school_level['id'] == $question_to_edit->getIdSchoolLevel()) ? 'selected' : null ?>><?= $school_level[1] ?></option>
					<?php }  ?>
				</select>
			</div>

			<input type="file" id="question-picture" name="question-picture" class="inputfile" accept="image/png, image/jpeg, image/gif">
			<label for="question-picture" class="add-picture"><i class="fas fa-plus-circle"></i> Facultatif : Modifier l'image</label>

			<p>Enoncé</p>
			<textarea name="enonce" id="enonce-editor" cols="60" rows="10" required><?= $question_to_edit->getEnonce() ?></textarea>
			<textarea name="answer1" id="answer1" cols="60" rows="10" placeholder="Réponse 1" required><?= $question_to_edit->getAnswer1() ?></textarea>
			<textarea name="answer2" id="answer2" cols="60" rows="10" placeholder="Réponse 2" required><?= $question_to_edit->getAnswer2() ?></textarea>
			<textarea name="answer3" id="answer3" cols="60" rows="10" placeholder="Réponse 3" required><?= $question_to_edit->getAnswer3() ?></textarea>
			<textarea name="answer4" id="answer4" cols="60" rows="10" placeholder="Réponse 4" required><?= $question_to_edit->getAnswer4() ?></textarea>
			<select name="solution_number" id="solution_number">
					<option value="0" disabled>Solution</option>
					<option value="1" <?= ($question_to_edit->getSolutionNumber() == 1) ? 'selected': null ?>>1</option>
					<option value="2" <?= ($question_to_edit->getSolutionNumber() == 2) ? 'selected': null ?>>2</option>
					<option value="3" <?= ($question_to_edit->getSolutionNumber() == 3) ? 'selected': null ?>>3</option>
					<option value="4" <?= ($question_to_edit->getSolutionNumber() == 4) ? 'selected': null ?>>4</option>
			</select>

			<input type="file" id="solution-picture" name="solution-picture" class="inputfile" accept="image/png, image/jpeg, image/gif">
			<label for="solution-picture" class="add-picture"><i class="fas fa-plus-circle"></i> Facultatif : Modifier l'image</label>

			<textarea name="soluce" id="soluce-editor" cols="60" rows="10" placeholder="Solution" required><?= $question_to_edit->getSoluce() ?></textarea>
			<input type="hidden" name="id" value="<?= $question_to_edit->getGlobalId(); ?>">
			<input type="hidden" name="action" value="3V">
			<input type="hidden" name="section" value="questions">
			<input type="submit" value ="Créer">
		</form>
	</div>	

</div>
<!-- CKeditor script -->
<script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#enonce-editor' ), {
        toolbar: [ 'heading','bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ]
    })
        .catch( error => {
            console.error( error );
        } )
        /*.then( editor => {
        console.log( Array.from( editor.ui.componentFactory.names() ) );
    } )*/;
    ClassicEditor
        .create( document.querySelector( '#soluce-editor' ), {
        removePlugins: [ 'Link' ],
        toolbar: [ 'heading','bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
    } )
        .catch( error => {
            console.error( error );
        } );    
</script>
<!-- CKeditor script -->
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');	