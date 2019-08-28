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

			<section>
				<table class="stats-table">
					<thead><th>Users</th><th>Questions done</th><th>Courses done</th><th>Date</th></thead>
					<tbody>
				<?php 

				foreach ($list_of_stats as $daily_stat) { ?>
					<tr>
					<td><?= $daily_stat['today_number_of_users'] ?></td>
					<td><?= $daily_stat['today_quantities_questions'] ?></td>
					<td><?= $daily_stat['today_quantities_courses'] ?></td>
					<td><?= $daily_stat['simplified_date'] ?></td>
					</tr>
				<?php
			}
				?>
				</tbody>
				</table>
			</section>

	</main>
</div>
<?php 

$view= ob_get_clean();
include('view/back/templateBack.php');

?>