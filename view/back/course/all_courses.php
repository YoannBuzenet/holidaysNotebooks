<?php 

ob_start();

?>
<div class="container">
	VUE DE ALL COURSES
</div>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>