<?php
session_start();

$Adresse = $_POST["ADRESSE"];
$Ville = $_POST["VILLE"];
$CodeP = $_POST["CodeP"];
$Largeur = $_POST["Largeur"];
$Hauteur = $_POST["Hauteur"];
$Description = $_POST["DESCRIPTION_DU_PROJET"];
$DATE = !empty($_POST["Date"]) ? date('Y-m-d', strtotime($_POST["Date"])) : null;
$STYLEMOSAIQUE = $_POST["STYLEMOSAIQUE"];
$IDP = $_GET["idp"];

//connexion à la BDD
require "config.php";
$bdd = connect();

// Suppression du projet avant modification
$sqldel = "DELETE FROM projet WHERE id_projet = :id_projet";
$stmtDel = $bdd->prepare($sqldel);
$stmtDel->execute(['id_projet' => $IDP]);

// Requête d'insertion avec ou sans date
if (is_null($DATE)) {
    $sql = "INSERT INTO projet (id_projet, ADRESSE, VILLE, CodeP, DESCRIPTION_DU_PROJET, STYLEMOSAIQUE, Largeur, Hauteur)
            VALUES (:id_projet, :adresse, :ville, :codeP, :description, :STYLEMOSAIQUE, :largeur, :hauteur)";
} else {
    $sql = "INSERT INTO projet (id_projet, ADRESSE, VILLE, CodeP, Delai_Projet, DESCRIPTION_DU_PROJET, STYLEMOSAIQUE, Largeur, Hauteur)
            VALUES (:id_projet, :adresse, :ville, :codeP, :delai_Projet, :description, :STYLEMOSAIQUE, :largeur, :hauteur)";
}

// Préparation de la requête
$stmt = $bdd->prepare($sql);

// Liaison des paramètres
$stmt->bindParam(':id_projet', $IDP);
$stmt->bindParam(':adresse', $Adresse);
$stmt->bindParam(':ville', $Ville);
$stmt->bindParam(':codeP', $CodeP);
$stmt->bindParam(':description', $Description);
$stmt->bindParam(':STYLEMOSAIQUE', $STYLEMOSAIQUE);
$stmt->bindParam(':largeur', $Largeur);
$stmt->bindParam(':hauteur', $Hauteur);

if (!is_null($DATE)) {
    $stmt->bindParam(':delai_Projet', $DATE, PDO::PARAM_STR);
}

// Exécution de la requête
$stmt->execute();

// Redirection après modification
header('Location: projet.php?modif=' . $IDP);
?>
