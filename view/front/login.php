<?php

//Beginning of the view
ob_start();
?>


<?php 
if(isset($_GET['access']) && $_GET['access'] == "failed"){ ?>
	<div class="alert-wrapper">
		<p class="alert problem">Mauvais Login ou mot de passe. Merci de rééssayer.</p>
  </div>
<?php } ?>
	
<div class="container">

	<div class="form-wrap">
		<p>Please Log In.</p>

		<form action="index.php" method="POST" class="gol">
			<label for="user_login">Login</label><input type="text" id="user_login" name="user_login">
			<label for="user_pass">Mot de passe</label><input type="password" id="user_pass" name="user_pass">
			<input type="submit" value="Send">
		</form>

	</div>
</div>

<?php
$view = ob_get_contents();

//End of the view
ob_end_clean();

include('view/front/templateFront.php');

?>