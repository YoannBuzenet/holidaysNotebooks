<?php 

include('model/appStatistics/appStatistics.php');

//Check and preparation here

$list_of_stats = appStatistics::getDailyMetrics($bdd);


include('view/back/home.php');
?>