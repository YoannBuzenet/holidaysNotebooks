<?php 

ob_start();

//var_dump($course);
?>
<h1>Politique de cookie</h1>

<p>Un cookie est un petit fichier texte permettant de stocker des informations, qui est installé par le site web sur le navigateur de l'utilisateur.</p>

<p>Notre site enregistre un cookie pour sauvegarder l'avancée de l'utilisateur dans les cahiers de vacances.
Le nom de ce cookie est "cookie_id". Il est supprimé automatiquement au bout de 3 mois.</p>

<p>C'est le seul cookie utilisé sur le site.</p>

<p>Pour supprimer vos cookies, vous pouvez accéder aux paramètres de votre navigateur web et supprimer l'historique. Sachez toutefois que vous pouvez perdre certaines informations sauvegardées, telles que des préférences ou des authentifications.</p>

<?php 

$view = ob_get_clean();
include('view/front/templateFront.php');
 ?>