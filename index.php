<?php
error_reporting(E_ALL & ~E_NOTICE);

include_once('include/initialization.php');


function is_valid_email($mail){
	return filter_var($mail, FILTER_VALIDATE_EMAIL);
};


$mail = trim(strip_tags($_POST['mail']));
$errors = array();
if(!empty($_POST)){
	if(empty($_POST['mail'])){
		$errors['mail'] = 'Le mail est obligatoire';
	}

	else if( is_valid_email($mail) == false){
		echo('ton email n\'est pas valide');
	}

	else if(mailExists($connexion, $_POST['mail'])){
		$errors['mail'] = 'Ce mail est déjà dans notre base de donnée';
	}

	else if(empty($errors)){
		$sql = 'INSERT INTO user(mail)
		VALUES(:mail)';
		$preparedStatement = $connexion->prepare($sql);
		$preparedStatement->bindValue('mail', htmlentities($_POST['mail']));

		if($preparedStatement->execute()){
			$_SESSION['user_secret'] = $secret;
			echo('Vous avez bien été ajouté à la liste.');
		}
	}
}
?>


<!doctype html>
<html lang="fr">
<head>
		<meta charset="UTF-8">
		<title>mail</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style type="text/css">

</style>
</head>
<body>
  <div id="content">
  

			<?php foreach($errors as $error): ?>
				<div class="alert error"><?php echo $error; ?></div>
			<?php endforeach; ?>

		  <form method="post">
		    <fieldset>
		      <label>mail</label>
		      <input type="text" name="mail" />
		    </fieldset>
		     <input type="submit" class="button" name="envoyer" />
		  </form>

		  <a href="admin.php" class="bouton_admin">admin</a>
</div>

	</div>
</body>
</html>
