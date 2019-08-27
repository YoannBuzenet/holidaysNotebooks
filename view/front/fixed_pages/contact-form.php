<?php 

ob_start();

//var_dump($course);
?>
<h1>Formulaire de contact</h1>



<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>