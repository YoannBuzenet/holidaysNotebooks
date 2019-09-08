<?php 

ob_start();

//var_dump($course);
?>
<h1>Mentions légales</h1>

<p>Hébergeur : OVH Siège social : 2 rue Kellermann - 59100 Roubaix - France</p>

<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>