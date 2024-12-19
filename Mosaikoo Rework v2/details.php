<?php
session_start() ;
if (empty($_SESSION['autorisation'])){
	header("Location: index.php");
	exit();
	
}
//connexion à la BDD
require "config.php";
$bdd = connect();

//$modif = $_GET['modif'];
//$_SESSION['modif'] = $modif;

//Stagiaire 2024 -  Définis une valeur par défaut ou gere le cas où 'modif' est absent
if (isset($_GET['modif'])) {
    $modif = $_GET['modif'];
} else {
    $modif = ''; 
}

// Stagiaire 2024 correction du code et de la base de donnée 
$sql = "select id_etat,VILLE,EMAIL,NOM,PRENOM,LIBELLE, Date_prospect,id_prospect,numero_telephone,ADRESSE_IP,date_creation,Projet from prospect natural join etat_prospect where id_prospect='$modif'";
$resultat = $bdd->query($sql);

?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="container">
		<div class="row center mt-5">
			<div class="col-md-4 col-sm-6 mx-auto">
				<form method="POST" action="modifier_prospect.php?idp=<?php echo $modif; ?>" >
					<?php 
					while ($prospect = $resultat->fetch(PDO::FETCH_OBJ))
					{
					?>
					
					<div>
					<p class="text-white text-center"># <?php echo $prospect->id_prospect.' | '.$prospect->LIBELLE?></p>
					</div>

					<div class="detail">
						<div>
							<label>NOM :</label>
							<input type="text" name="Nom" placeholder="Nom" value="<?php echo $prospect->NOM?>">
						</div>
						<div>
							<label>Prénom :</label>
							<input type="text" name="PRENOM" placeholder="PRENOM" value="<?php echo $prospect->PRENOM?>">
						</div>
						<div>
							<label>Email :</label>
							<input type="text" name="EMAIL" placeholder="EMAIL" value="<?php echo $prospect->EMAIL?>">
						</div>
						<div>
							<label>Ville :</label>
							<input type="text" name="VILLE" placeholder="VILLE" value="<?php echo $prospect->VILLE?>">
						</div>					
						<div>
							<label>Téléphone :</label>
							<input type="text" name="numero_telephone" placeholder="numero_telephone" value="<?php echo $prospect->numero_telephone?>">
						</div>				
						<div>
							<label>Adresse IP :</label>
							<input type="text" name="ADRESSE_IP" placeholder="ADRESSE_IP" value="<?php echo $prospect->ADRESSE_IP?>">
						</div>
						<div>
                            <label>Création du client :</label>
                            <input type="date" name="date_creation" placeholder="date_creation" value="<?php echo $prospect->date_creation?>">
                        </div>
						<div>
							<label>Status :</label>
							<select name="Status">
								<option value="<?php echo $prospect->id_etat?>" selected><?php echo $prospect->LIBELLE?></option>
								<option value="1">En cours</option>
								<option value="2">Client</option>
								<option value="3">Terminé</option>
							</select>
						</div>						
						<div>
							<label>Projet :</label>
							<select name="Projet">
								<option value="<?php echo $prospect->Projet?>" selected><?php echo $prospect->Projet?></option>
								<option value="Deco maison">Déco maison</option>
								<option value="Salle de bain">Salle de bain</option>
								<option value="Piscine">Piscine</option>
								<option value="Entreprise">Entreprise</option>
								<option value="Espace urbain">Espace Urbain</option>
							</select>
						</div>
					</div>
					<?php 
					}
					?>

					<br />

					<div class="d-flex justify-content-center">
						<button type="submit" class="btn btn-primary">Enregistrer</button>
					</div>

					<a class="btn btn-outline-info mb-5 mt-5  " href="prospect.php">Revenir a la liste</a>

				</form>
			</div>
		</div>
	</div>

</body>
</html>