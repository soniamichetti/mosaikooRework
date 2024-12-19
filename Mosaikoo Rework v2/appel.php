
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

$modif = $_GET['modif'];
$_SESSION['modif'] = $modif;

$sql = "SELECT id_appel,CONTENU_D_APPEL,id_prospect, NUMERO_DE_TELEPHONE,Date from appel natural join prospect  where id_prospect='$modif'";
$resultat = $bdd->query($sql);

?>
   
	<title>Appel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    
</head>

</html>
<body>

<div class="container text-center">

  	<div class="row mt-3">
  	 	<div class="col"> <h2> Appel :  </h2></div>
	</div>
	<div class="row">


<div class="container">
	<?php
	//connexion à la BDD
	//affichage des resultats dans un objet
	while ($appel = $resultat->fetch(PDO::FETCH_OBJ))
	{
	?>
		<div class="inline-block">
			<div class="card" style="margin:15px;">
				<h5 class="card-header bg-dark text-white"><?php echo $appel->NUMERO_DE_TELEPHONE  ?></h5>
				<p class="card-text" style="color:black"><?php echo $appel->CONTENU_D_APPEL ?></p>
				<p class="card-text" style="color:black"><?php echo $appel->Date ?></p>
			</div>
		</div>
	</br>

	<?php
	}
	?>
</div>

		<div class="container">
		    <h3 class="text-center">Nouvel Appel</h3>
			<div class="row center mt-5">
				<div class="col-md-8 col-sm-10 mx-auto">
					<form method="POST" action="ajouter_appel.php?idp=<?php echo $modif; ?>" enctype='multipart/form-data'>
						<div class="form-group">
        					<label for="formGroupExampleInput">NUMERO DE TELEPHONE</label>
							<input type="text" class="form-control"  name="NUMERO_DE_TELEPHONE" placeholder=" NUMERO DE TELEPHONE" value="">
						</div>
						
						<div class="form-group">
							<label for="formGroupExampleInput">Date de l'appel : </label>
							<input type="date" name="Date">
						</div>

						<div class="form-group">
							<label for="formGroupExampleInput">	CONTENU D 'APPEL</label>
							<textarea class="form-control"  name="CONTENU_D_APPEL" placeholder="	CONTENU D'APPEL" value="" rows="7"></textarea>
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
			
              		                                           
            
