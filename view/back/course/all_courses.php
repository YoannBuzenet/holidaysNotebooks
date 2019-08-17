<?php 



ob_start();
?>
<div class="container">

	<div class="command-section">
		<a href="index.php?section=courses&action=2">
			<div class="command-action">
				<i class="fas fa-plus-circle"></i></i>
				<p>Créer un parcours</p>
			</div>
		</a>
	</div>
	
	<div class="table-course">
		<h2>Parcours</h2>
	<table>
		<thead>
			<tr>
				<th>ID</th><th>Name</th><th>Questions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($listCourses as $course){ ?>
				<tr><td><?= $course->getId() ?></td><td><?= $course->getName() ?></td><td><?= $course->getNumberOfQuestions() ?></td></tr>
			<?php } ?>
		</tbody>
	</table>

	</div>

</div>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>