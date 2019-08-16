<?php 



ob_start();
?>
<div class="container">

	<?php  if(isset($success) && $success){
?><div class="alert-wrapper">
		<p class="alert success">La question a bien été ajoutée en base de données.</p>
  </div><?php
  //Reinitializing param
	$success = null;
}?>

	<div class="command-section">
		<a href="index.php?section=questions&action=2">
			<div class="command-action">
				<i class="fas fa-plus-circle"></i></i>
				<p>Créer une question</p>
			</div>
		</a>
	</div>
	
	<div class="table-course">
		<h2>Toutes les questions</h2>
	<table>
		<thead>
			<tr>
				<th>ID</th><th>Name</th><th>Discipline</th><th>Success Rate</th><th>Type</th><th>Level</th><th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($listQuestions as $question){ ?>
				<tr><td><?= $question->getId() ?></td><td><?= $question->getName() ?></td><td><?= $question->getDiscipline() ?></td><td><?= $question->getSuccessRate() ?>%</td><td><?= $question->getType() ?></td><td><?= $question->getSchoolLevel() ?></td><td><a href="index.php?section=questions&action=3&id=<?= $question->getId(); ?>"><i class="fas fa-edit"></a></i></td></tr>
			<?php } ?>
		</tbody>
	</table>

	</div>

</div>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>