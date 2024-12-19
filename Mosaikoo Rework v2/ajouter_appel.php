<?php
session_start();

$NUMERO_DE_TELEPHONE = $_POST["NUMERO_DE_TELEPHONE"];
$CONTENU_D_APPEL = $_POST["CONTENU_D_APPEL"];
$DATE = date('Y-m-d', strtotime($_POST["Date"]));
$IDP = $_GET["idp"];


//connexion à la BDD
require "config.php" ;
$bdd=connect() ;
			

//requête	insertion

$sql = "insert into appel(NUMERO_DE_TELEPHONE,CONTENU_D_APPEL,id_prospect,Date) VALUES('$NUMERO_DE_TELEPHONE','$CONTENU_D_APPEL','$IDP','$DATE')";
if ($DATE=='1970-01-01'){
	$sql = "insert into appel(NUMERO_DE_TELEPHONE,CONTENU_D_APPEL,id_prospect) VALUES('$NUMERO_DE_TELEPHONE','$CONTENU_D_APPEL','$IDP')";
}

//execution de la requête
$resultat = $bdd->query($sql);


    header('location:appel.php?modif='.$IDP.'');


?>


