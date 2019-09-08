<?php 

ob_start();


//var_dump($course);
?>

<?php  if(isset($success) && $success){ ?>
	<div class="alert-wrapper">
		<p class="alert success"><?= $message ?></p>
  </div>
  <?php
  //Reinitializing param
	$success = null;
}?>	


<h1>Formulaire de contact</h1>

<form action="index.php" Method="POST">
	<label for="message-title">Objet du message</label>
	<input type="text" name="message-title" id="message-title" required>
	<label for="message">Votre message</label>
	<textarea name="message" id="" cols="30" rows="10" required></textarea>
	<input type="hidden" name="section" value="contact-us">
	<input type="submit">
</form>


<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>