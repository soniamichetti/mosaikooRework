<?php
require "function.php";

if(isset($_POST['connexion'])){
	verif();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="login">
		<h1>login</h1>
		<form method="POST" enctype='multipart/form-data'>
			<span>
				<i class="fa fa-user"></i>
				<input type="text" placeholder="Username" name="login">
			</span>
			<br>
			<span>
				<i class="fa fa-lock"></i>
				<input type="password" placeholder="password" name="mdp">
				<br>
					<input class="connexion" type="submit" value="connexion" name="connexion">
			</span><br>
		</form>
	</div>

</body>
</html>