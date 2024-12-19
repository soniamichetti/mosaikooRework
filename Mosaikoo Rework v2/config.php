<?php

//constantes de connexion
define("HOTE", 'localhost') ;
define("BDD", 'bdmosaiquedv') ;
define("UTILISATEUR", 'root') ;
define("MDP", '') ;

//fonction de connexion

function connect()
{
	try
	{
		$connect= new PDO('mysql:host='.HOTE.';dbname='.BDD , UTILISATEUR, MDP, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8')) ;
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
		return $connect ;
	}
	catch(PDOException $e)
	{
		echo "problème de connexion à la BDD <br>". $e->getMessage() ;
	}

	
}


?>
