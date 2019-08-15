<?php 

ob_start();

?>

<article class="question">
	<div class="progress-wrapper">
		<progress value="20" max="100">20</progress>
	</div>
	<h1>PARTIE : MATHEMATIQUES</h1>
	<small>Question 2</small>

	<p>Enoncé</p>

	<form action="#" method="POST" id="" class="question-form">
		<div class="form-container">
			<div class="answer">
			  <input type="radio" id="huey" name="question" value="huey">
			  <label for="huey">Blip</label>
			</div>

			<div class="answer">
			  <input type="radio" id="dewey" name="question" value="dewey">
			  <label for="dewey">Bloup</label>
			</div>

			<div class="answer">
			  <input type="radio" id="louie" name="question" value="louie">
			  <label for="louie">Blap</label>
			</div>

			<div class="answer">
			  <input type="radio" id="louie2" name="question" value="louie">
			  <label for="louie2">Blouh</label>
			</div>
		</div>	
		
		<input type="button" id="form-validate" value="Suivant">
	</form>
	
</article>
				
<script type="text/javascript" src="public/js/course.js"></script>

<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>