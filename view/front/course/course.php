<?php 

ob_start();

//var_dump($next_question);
?>

<article class="question" id="main-article" data-idquestion="<?= $next_question->id_question ?>" data-idtype="<?= $next_question->getIdType() ?>">
	<p class="course-title"><?= $course->school_level ?> - <?= $course->general_level ?></p>
	<div class="progress-wrapper">
		<progress value="<?= $next_question->getOrderNumber()+1 ?>" max="<?= $next_question->getTotalQuestions() ?>"><?= $next_question->getOrderNumber()+1 ?></progress>
	</div>
	<h1>PARTIE : <?= strtoupper($next_question->getDiscipline()) ?></h1>
	<small>Question <?= $next_question->getOrderNumber() + 1 ?></small>

	<!-- Implementing the picture if there's one -->
	<?php if(!empty($next_question->getURLPictureMain())){ ?>
		<div class="img-statement">
			<img src="<?= $next_question->getURLPictureMain() ?>" alt="question-picture">
		</div>
	<?php } ?>

	<p><?= $next_question->getEnonce() ?></p>

	<form action="index.php?section=courses&action=3&id=<?= $next_question->id_course ?>" method="POST" id="question-form" class="question-form">
		<div class="form-container">
			<div class="answer">
			  <input type="radio" id="answer1" name="question" value="1">
			  <label for="answer1"><?= $next_question->getAnswer1()  ?></label>
			</div>

			<div class="answer">
			  <input type="radio" id="answer2" name="question" value="2">
			  <label for="answer2"><?= $next_question->getAnswer2()  ?></label>
			</div>

			<div class="answer">
			  <input type="radio" id="answer3" name="question" value="3">
			  <label for="answer3"><?= $next_question->getAnswer3()  ?></label>
			</div>

			<div class="answer">
			  <input type="radio" id="answer4" name="question" value="4">
			  <label for="answer4"><?= $next_question->getAnswer4()  ?></label>
			</div>
		</div>	
		
		<input type="button" id="form-validate" value="Suivant">
		<input type="hidden" name="next_question" value="<?= $next_question->getOrderNumber()+1 ?>">

	</form>
	
</article>
				
<script type="text/javascript" src="public/js/course.js"></script>

<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>