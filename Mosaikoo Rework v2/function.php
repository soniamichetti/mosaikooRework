<?php

function verif(){
	session_start() ;	

		// Récupération des données saisies dans le formulaire d’identification
	$login=$_POST["login"] ;
	$mdp=md5($_POST["mdp"]) ;
	// Connexion au serveur de BDD
	$bdd= new PDO('mysql:host=localhost;dbname=BDMOSAIQUE2','root','');

	// Requête de recherche du mot de passe de l’admin à partir de l’identifiant saisi
	$sql="select * from admin where login='$login' and mdp='$mdp'" ;
		
	// Execution de la requête
	$resultat=$bdd->query($sql) ;
	$rep = $resultat->fetch(PDO::FETCH_BOTH) ;
	$nb_lignes= $resultat->rowCount() ;
						
	if ($nb_lignes>0) 
		{
		$_SESSION["admin"]= "OK" ;
		$_SESSION["autorisation"]="OK" ;
		header("Location: prospect.php");
	
		}
		else
		{
			
		echo '<script type="text/javascript">
			window.onload = function () { alert("identifiant ou mot de passe non valide"); } 
		</script>';
		}
	}


	

?>