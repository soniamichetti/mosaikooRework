<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nom = $_POST["Nom"];
    $PRENOM = $_POST["PRENOM"];
    $EMAIL = $_POST["EMAIL"];
    $VILLE = $_POST["VILLE"];
    $numero_telephone = $_POST["numero_telephone"];
    $ADRESSE_IP = $_POST["ADRESSE_IP"];
    $date_creation = $_POST["date_creation"];
    $Status = $_POST["Status"];
    $Projet = $_POST["Projet"];
    $IDP = $_GET["idp"];

    // Connexion à la BDD
    require "config.php";
    $bdd = connect();

    // Requête SQL préparée pour éviter les injections SQL
    $sql = "UPDATE prospect 
            SET NOM = :Nom, 
                PRENOM = :PRENOM, 
                VILLE = :VILLE, 
                EMAIL = :EMAIL,
                date_creation = :date_creation, 
                ADRESSE_IP = :ADRESSE_IP, 
                id_etat = :Status, 
                Projet = :Projet, 
                numero_telephone = :numero_telephone 
            WHERE id_prospect = :IDP";

    // Préparer la requête
    $stmt = $bdd->prepare($sql);
    
    // Exécuter la requête
    $stmt->execute([
        ':Nom' => $Nom,
        ':PRENOM' => $PRENOM,
        ':EMAIL' => $EMAIL,
        ':VILLE' => $VILLE,
        ':ADRESSE_IP' => $ADRESSE_IP,
        ':date_creation' => $date_creation,
        ':Status' => $Status,
        ':Projet' =>$Projet,
        ':numero_telephone' => $numero_telephone,
        ':IDP' => $IDP
    ]);

    // Redirection vers la liste des prospects
    header('Location: prospect.php');
    exit();
}
?>