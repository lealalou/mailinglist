<?php
error_reporting(E_ALL & ~E_NOTICE);

include_once('include/initialization.php');

if($admin = getConnectedAdmin($connexion)){
	redirectTo('list.php');
}

$errors = array();
$login = trim(strip_tags($_POST['login']));
$password = trim(strip_tags($_POST['password']));


if(!empty($_POST)){
	if(empty($login)){
		$errors['login'] = 'Le login est obligatoire';
	}
	if(empty($password)){
		$errors['password'] = 'Le password est obligatoire';
	}


	if(empty($errors)){
		$sql = 'SELECT * FROM admin WHERE login = :login';
		$preparedStatement = $connexion->prepare($sql);
		$preparedStatement->bindValue(':login', $_POST['login']);
		$preparedStatement->execute();
		$admin = $preparedStatement->fetch();
		printf("uniqid('', true): %s\r\n", uniqid('', true));
	
	}
}
?>

<!doctype html>
<html class="no-js" lang="fr">
<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<style type="text/css">
body {
font-family: 'Montserrat';
background: #DD5E89;
background: -webkit-linear-gradient(to left, #DD5E89 , #F7BB97); 
background: linear-gradient(to left, #DD5E89 , #F7BB97);  }
#content {background: white; width: 500px; margin: 50px auto; height: 500px;}

fieldset{border: none;margin-left: 40px;top:90px;position: relative;}

textarea{width: 90%;
		 height: 100px;
		 margin: 10px auto;}

input {
  width: 85%;
  margin: 10px auto;
  height: 50px;
  padding: 0 15px 2px;
  background: white;
  border: 2px solid #ebebeb;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 -2px #ebebeb;
  box-shadow: inset 0 -2px #ebebeb;
}
input:focus {
  border-color: #F7BB97;
  outline: none;
  -webkit-box-shadow: inset 0 -2px #F7BB97;
  }

 .button {position: relative; top:110px;left: 40px;}
</style>
</head>
<body>


<div id="content">

  	<div>

			<?php foreach($errors as $error): ?>
			<div><?php echo $error; ?></div>
			<?php endforeach; ?>

		  <form method="post" action="">


		   	<fieldset>
		      <label>Login</label>
		      <input type="text" name="Login" />
		    </fieldset>


		    <fieldset>
		      <label>Password</label>
		      <input type="text" name="Password" />
		    </fieldset>

			
		      <input type="submit" class="button" name="envoyer" />
		   
		  </form>
		</div>

	 </div> <!-- container -->
	
</body>
</html>
