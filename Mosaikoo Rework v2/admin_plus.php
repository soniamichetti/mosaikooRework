<?php
session_start() ;
if (empty($_SESSION['autorisation'])){
	header("Location: index.php");
	exit();
	
}
?>



<html>
<head>
	<meta charset="utf-8">
    <?php
//connexion à la BDD
require "config.php";
$bdd = connect();

?>
   
	<title>Appel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>

        <h3 class="text-center">Nouvel Admin</h3>
        <div class="row center mt-5">
            <div class="col-md-8 col-sm-10 mx-auto">
                <form method="POST" action="ajouter_admin.php" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Admin :</label>
                        <input type="text" class="form-control"  name="LOGIN" placeholder="Nom de l'admin" value="">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Mot de passe :</label>
                        <input type="text" class="form-control"  name="MDP" placeholder="Mot de passe" value="">
                    </div>

                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                    
                    <a class="btn btn-outline-info mb-5 mt-5  " href="prospect.php">Revenir a la liste</a>
                </form>
            </div>
        </div>      
		
</body>
</html>