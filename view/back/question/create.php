<?php 
ob_start();
?>
<div class="container">
	<h2>Créer une question</h2>
	<div class="form-container">
		<form action="index.php" method="POST" class="create-form" enctype="multipart/form-data">

			
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

			<input type="file" id="question-picture" name="question-picture" class="inputfile" accept="image/png, image/jpeg, image/jpg, image/gif">
			<label for="question-picture" class="add-picture"><i class="fas fa-plus-circle"></i> Facultatif : Ajouter une image</label>

			<p>Enoncé</p>
			<textarea name="enonce" id="enonce-editor" cols="60" rows="10" placeholder="Enonce"></textarea>
			<textarea name="exercice" id="exercice-editor" cols="60" rows="10" placeholder="Exercice"></textarea>
			<textarea name="answer1" id="answer1" cols="60" rows="10" placeholder="Réponse 1" required></textarea>
			<textarea name="answer2" id="answer2" cols="60" rows="10" placeholder="Réponse 2" required></textarea>
			<textarea name="answer3" id="answer3" cols="60" rows="10" placeholder="Réponse 3" required></textarea>
			<textarea name="answer4" id="answer4" cols="60" rows="10" placeholder="Réponse 4" required></textarea>
			<select name="solution_number" id="solution_number">
					<option value="0" selected disabled>Solution</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
			</select>

			<input type="file" id="solution-picture" name="solution-picture" class="inputfile" accept="image/png, image/jpeg, image/jpg, image/gif">
			<label for="solution-picture" class="add-picture"><i class="fas fa-plus-circle"></i> Facultatif : Ajouter une image pour la solution</label>

			<textarea name="soluce" id="soluce-editor" cols="60" rows="10" placeholder="Solution"></textarea>
			<input type="hidden" name="action" value="2V">
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
    ClassicEditor
        .create( document.querySelector( '#exercice-editor' ), {
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

?>