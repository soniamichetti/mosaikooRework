<?php

require "function.php";
$compteur=0;
session_start() ;
if (empty($_SESSION['autorisation'])){
	header("Location: index.php");
	exit();
}

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   

$url.= $_SERVER['HTTP_HOST'];   
$url.= $_SERVER['REQUEST_URI']; #La on a chopper l'url actuel

$url_components = parse_url($url); #on sépare l'url dans une liste

if(isset($url_components['query'])){ #on check si l'url a des paramètres
    $nom = $_GET['nom'];
}
else{
    $nom='';
}
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Prospects</title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="navbar">
        <div class ="recherche">
            <label for="">Rechercher</label>
            <form action="prospect.php" method="get">
                <input type="text" value="" name="nom"></input>
                <input type="submit" value="⇨" style="background-color:lime"/>
            </form>
        </div>
        <div><h2> Liste des prospects </h2></div>
        <div class="">
            <a class="creerad" href="admin_plus.php"><strong>Créer admin</strong></a>
            <a class="deconnexion" href="deconnexion.php"><strong>Déconnexion</strong></a>
        </div><style>
            div.add-prospect button{
            margin:20px;
        }
        </style>
</br>
        
    </div>
    
        <div class="add-prospect">
        <a href='addProspect.php'><button type="submit" class="btn btn-primary">Ajouter un nouveau prospect</button></a>
        </div>

    <div class='container_liste'>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Mail</th>
                    <th>Détails</th>
                    <th>Projet</th>
                    <th>Appel</th>
                    <th>Image</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
                // Connexion à la BDD
                require "config.php";
                $bdd = connect();

                // Requête SQL pour obtenir les prospects avec la recherche par nom
                $sql = "SELECT id_etat, VILLE, EMAIL, NOM, PRENOM, LIBELLE, Date_prospect, date_creation, id_prospect, numero_telephone 
                FROM prospect 
                NATURAL JOIN etat_prospect 
                WHERE NOM LIKE :nom 
                ORDER BY FIELD(id_etat, 1, 2, 3), date_creation ASC, NOM ASC";

                $stmt = $bdd->prepare($sql);
                $stmt->execute([':nom' => '%' . $nom . '%']);

                $compteur = 0;

                // Affichage des résultats
                while ($prospect = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $compteur += 1;
                    ?>
                    <tr class="ligne<?php echo ($compteur % 2); ?>">
                        <td><?php echo htmlspecialchars($prospect->NOM . ' ' . $prospect->PRENOM); ?></td>
                        <td><?php echo htmlspecialchars($prospect->EMAIL); ?></td>
                        <td><a class="button" href="details.php?modif=<?php echo htmlspecialchars($prospect->id_prospect); ?>"><i class="fa fa-user-plus"></i></a></td>
                        <td><a class="button" href="projet.php?modif=<?php echo htmlspecialchars($prospect->id_prospect); ?>"><i class="fa fa-gavel"></i></a></td>
                        <td><a class="button" href="appel.php?modif=<?php echo htmlspecialchars($prospect->id_prospect); ?>"><i class="fa fa-phone"></i></a></td>
                        <td><a class="button" href="images.php?modif=<?php echo htmlspecialchars($prospect->EMAIL); ?>"><i class="fa fa-image"></i></a></td>
                        <td>
                            <?php 
                            if ($prospect->id_etat == 1) {
                                echo "<p class='encours'>En cours</p>";
                            } elseif ($prospect->id_etat == 2) {
                                echo "<p class='client'>Client</p>";
                            } else {
                                echo "<p class='termine'>Terminé</p>";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>

</body>
</html>
