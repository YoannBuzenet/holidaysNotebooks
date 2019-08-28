<?php 



ob_start();
?>
<div class="container">

	<?php  if(isset($success) && $success){
?><div class="alert-wrapper">
		<p class="alert success"><?= $message ?></p>
  </div><?php
  //Reinitializing param
	$success = null;
}?>	

<?php  if(isset($problem) && $problem){
?><div class="alert-wrapper">
		<p class="alert problem"><?= $message ?></p>
  </div><?php
  //Reinitializing param
	$problem = null;
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
				<th>ID</th><th>Name</th><th>Discipline</th><th>Type</th><th>Level</th><th>Edit</th><th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($listQuestions as $question){ ?>
				<tr>
					<td><?= $question->getId() ?></td>
					<td><?= $question->getName() ?></td>
					<td><?= $question->getDiscipline() ?></td>
					<td><?= $question->getType() ?></td>
					<td><?= $question->getSchoolLevel() ?></td>
					<td><a href="index.php?section=questions&action=3&id=<?= $question->getId(); ?>"><i class="fas fa-edit"></a></i></td>
					<td><a href="index.php?section=questions&action=4&id=<?= $question->getId(); ?>"><i class="fas fa-minus-circle"></i></a></i></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	</div>

</div>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>