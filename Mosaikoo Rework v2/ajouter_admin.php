<?php
session_start();

$LOGIN = $_POST["LOGIN"];
$MDP = md5($_POST["MDP"]);

//connexion à la BDD
require "config.php" ;
$bdd=connect() ;
			

//requête
$sql = "insert into admin(LOGIN,MDP) VALUES('$LOGIN','$MDP')";

//execution de la requête
$resultat = $bdd->query($sql);


    header('location:prospect.php');


?>


