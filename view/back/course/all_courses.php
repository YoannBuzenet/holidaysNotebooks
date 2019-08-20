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
	<table class="course-table">
		<thead>
			<tr>
				<th>ID</th><th>Name</th><th>Questions</th><th>Niveau</th><th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($listCourses as $course){ ?>
				<tr>
					<td><?= $course['id'] ?></td>
					<td><?= $course['name'] ?></td>
					<td><?= $course['total_questions'] ?></td>
					<td><?= $course['slname'] ?></td>
					<td><a href="index.php?section=courses&action=3&id=<?= $course['id'] ?>"><i class="fas fa-edit"></a></i></td></tr>
			<?php } ?>
		</tbody>
	</table>

	</div>

</div>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>