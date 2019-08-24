<?php 

ob_start();

//var_dump($next_question);
?>

<article>

	<p>C'est la fin du cours ptn</p>
</article>
				


<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>