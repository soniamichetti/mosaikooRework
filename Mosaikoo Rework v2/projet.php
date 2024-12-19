<?php
session_start();
if (empty($_SESSION['autorisation'])) {
    header("Location: index.php");
    exit();
}
?>

<html>
<head>
    <meta charset="utf-8">
    <?php
    // Connexion à la BDD
    require "config.php";
    $bdd = connect();

    // Vérification de l'existence de l'ID de projet dans l'URL
    $modif = isset($_GET['modif']) ? $_GET['modif'] : '';

    // Requête de récupération des détails du projet
    $sql = "SELECT id_projet, ADRESSE, VILLE, CodeP, Delai_Projet, DESCRIPTION_DU_PROJET,STYLEMOSAIQUE, Largeur, Hauteur
            FROM projet WHERE id_projet = :id_projet";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['id_projet' => $modif]);
    $projet = $stmt->fetch(PDO::FETCH_OBJ);

    $style = isset($projet->STYLEMOSAIQUE) ? $projet->STYLEMOSAIQUE : 'Artistique';

    ?>


    <title>Projet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container text-center">
    <div class="row mt-3">
        <div class="col"> <h2>Le Projet</h2></div>
    </div>
    <div class="row">
        <form method="POST" action="modifier_OK_projet.php"></form>
    </div>

    <div class="container">
        <?php
        if ($projet) {
            ?>
            <div class="inline-block">
                <div class="card" style="margin:15px;">
                    <h5 class="card-header bg-dark text-white"><?php echo isset($projet->ADRESSE) ? $projet->ADRESSE : "Adresse non définie"; ?> | <?php echo isset($projet->VILLE) ? $projet->VILLE : "Ville non définie"; ?> <?php echo isset($projet->CodeP) ? $projet->CodeP : "Code postal non défini"; ?></h5>
                    <p style="color:black">Description :</p>
                    <p class="card-text" style="color:black"><?php echo isset($projet->DESCRIPTION_DU_PROJET) ? $projet->DESCRIPTION_DU_PROJET : "Description non définie"; ?></p>
                    <p class="card-header bg-dark text-white">date délai : <?php echo isset($projet->Delai_Projet) ? $projet->Delai_Projet : "Date non définie"; ?></p>
                    <p class="card-header bg-dark text-white">Style : <?php echo isset($projet->STYLEMOSAIQUE) ? $projet->STYLEMOSAIQUE : "Style non définie"; ?></p>
                    <p class="card-text" style="color:black"> Hauteur et largeur [ <?php echo isset($projet->Hauteur) ? $projet->Hauteur . 'm x ' . $projet->Largeur . 'm' : "Dimensions non définies"; ?> ]</p>
                </div>
            </div>
            <?php
        } else {
            echo "Aucun projet trouvé.";
        }
        ?>
    </div>

    <div class="container">
        <h3 class="text-center">Mise à jour ou création du projet</h3>
        <div class="row center mt-5">
            <div class="col-md-8 col-sm-10 mx-auto">
                <form method="POST" action="modifier_projet.php?idp=<?php echo $modif ?>" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label for="formGroupExampleInput">ADRESSE</label>
                        <input type="text" class="form-control" name="ADRESSE" placeholder="Adresse" value="<?php echo isset($projet->ADRESSE) ? $projet->ADRESSE : ''; ?>">
                        <input type="text" class="form-control" name="VILLE" placeholder="Ville" value="<?php echo isset($projet->VILLE) ? $projet->VILLE : ''; ?>">
                        <input type="text" class="form-control" name="CodeP" placeholder="CodeP" value="<?php echo isset($projet->CodeP) ? $projet->CodeP : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Description</label>
                        <textarea class="form-control" name="DESCRIPTION_DU_PROJET" placeholder="Description" rows="5"><?php echo isset($projet->DESCRIPTION_DU_PROJET) ? $projet->DESCRIPTION_DU_PROJET : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Date délai : </label>
                        <input type="date" name="Date" value="<?php echo isset($projet->Delai_Projet) ? $projet->Delai_Projet : ''; ?>">
                    </div>


                    <div class="form-group">
                        <label for="formGroupExampleInput">Style</label>
                        <select name="STYLEMOSAIQUE" class="form-control">
                        <option value="Artistique" <?php echo ($style == "Artistique") ? 'selected' : ''; ?>>Artistique</option>
                        <option value="Moderne" <?php echo ($style == "Moderne") ? 'selected' : ''; ?>>Moderne</option>
                        <option value="Melange" <?php echo ($style == "Melange") ? 'selected' : ''; ?>>Mélange</option>
                        <option value="Imprime" <?php echo ($style == "Imprime") ? 'selected' : ''; ?>>Imprimé</option>
                    </select>
                    </div>


                    <label for="formGroupExampleInput">Dimensions hxl (en mètres)</label>
                    <div class="d-flex column form-group">
                        <input type="text" class="form-control" name="Hauteur" placeholder="Hauteur" value="<?php echo isset($projet->Hauteur) ? $projet->Hauteur : ''; ?>">
                        <input type="text" class="form-control" name="Largeur" placeholder="Largeur" value="<?php echo isset($projet->Largeur) ? $projet->Largeur : ''; ?>">
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>

                    <a class="btn btn-outline-info mb-5 mt-5" href="prospect.php">Revenir à la liste</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
