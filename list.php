<?php
include_once('include/initialization.php');
		$query = $connexion->prepare('SELECT * FROM user' );
		$query->execute();
		$users = $query->fetchAll();
?>
<!doctype html>
<htmllang="fr">
<head>
		<meta charset="UTF-8">
		<title>Index</title>
</head>
<body>
	<section>
  	   <h1>Bienvenue</h1>
  	   <?php
  	   	foreach ($users as $user ) {
		  	echo'<pre>';
				print_r($user["mail"]);
			echo'</pre>';
		  }
  	   ?>
       <a href="logout.php" class="">Se déconnecter</a>
  	</section>
</body>
</html>