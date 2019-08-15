<?php 

ob_start();

?>
<div class="container">
	<main>
			<section>
				<h2>Voir les stats</h2>
				<div class="command-section">
						<div class="command-action">
							<a href=""><i class="fas fa-chart-area"></i></a>
							<p>Réussite des parcours</p>
						</div>
						<div class="command-action">
							<a href=""><i class="fas fa-question-circle"></i></i></a>
							<p>Réussite des questions</p>
						</div>
				</div>

			</section>

	</main>
</div>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>