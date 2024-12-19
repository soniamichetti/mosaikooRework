<?php
session_start();
require_once "config.php";

$pdo = connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_etat = 2; // Valeur par défaut de l'état (en cours)
    $nom = $_POST['NOM'];
    $email = $_POST['EMAIL'];
    $prenom = $_POST['PRENOM'];
    $ville = $_POST['VILLE'];
    $web_mobile = $_POST['WEB_MOBILE'];
    $systeme_exploitation = $_POST['SYSTEME_EXPLOITATION'];
    $adresse_ip = $_POST['ADRESSE_IP'];
    $maps = $_POST['MAPS'];
    $image_entree = $_POST['IMAGE_ENTREE'];
    $numero_telephone = $_POST['numero_telephone'];
    $navigateur = $_POST['Navigateur'];
    $date_prospect = $_POST['Date_prospect'];
    $date_creation = date("Y/m/d"); // Date actuelle

    $sql_check_email = "SELECT COUNT(*) FROM prospect WHERE EMAIL = :EMAIL";
    $stmt_check_email = $pdo->prepare($sql_check_email);
    $stmt_check_email->execute([':EMAIL' => $email]);
    $email_exists = $stmt_check_email->fetchColumn();

    if ($email_exists) {
        // Si l'email existe déjà, afficher un message d'erreur
        $error_message = "L'adresse email est déjà utilisée";
    } else {
        // Ne pas inclure ID_PROSPECT dans la requête INSERT, car il est auto-incrémenté
        $sql = "INSERT INTO prospect (ID_ETAT, NOM, EMAIL, PRENOM, VILLE, WEB_MOBILE, SYSTEME_EXPLOITATION, ADRESSE_IP, MAPS, IMAGE_ENTREE, NUMERO_TELEPHONE, NAVIGATEUR, DATE_PROSPECT,date_creation)
            VALUES (:ID_ETAT, :NOM, :EMAIL, :PRENOM, :VILLE, :WEB_MOBILE, :SYSTEME_EXPLOITATION, :ADRESSE_IP, :MAPS, :IMAGE_ENTREE, :NUMERO_TELEPHONE, :NAVIGATEUR, :DATE_PROSPECT, :date_creation)";

        // Préparation de la requête
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ID_ETAT' => $id_etat,
            ':NOM' => $nom,
            ':EMAIL' => $email,
            ':PRENOM' => $prenom,
            ':VILLE' => $ville,
            ':WEB_MOBILE' => $web_mobile,
            ':SYSTEME_EXPLOITATION' => $systeme_exploitation,
            ':ADRESSE_IP' => $adresse_ip,
            ':MAPS' => $maps,
            ':IMAGE_ENTREE' => $image_entree,
            ':NUMERO_TELEPHONE' => $numero_telephone,
            ':NAVIGATEUR' => $navigateur,
            ':DATE_PROSPECT' => $date_prospect,
            ':date_creation' => $date_creation,

        ]);
        header("Location: prospect.php");
        exit(); // N'oubliez pas de terminer le script pour éviter d'exécuter du code supplémentaire
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Ajouter un prospect</title>
</head>

<body>

    <?php
    // Afficher le message d'erreur si l'email existe déjà
    if (isset($error_message)) {
        echo "<p style='color: red; font-weight:bold; font-family:arial'>" . $error_message . "</p>";
    }
    ?>
    <div class="container">
        <div class="row center mt-5">
            <div class="col-md-4 col-sm-6 mx-auto">
                <form method="post">
                    <p class="text-center">Nouveau Prospect</p>
                    <div class="detail">
                        <div>
                            <label>Nom :</label>
                            <input type="text" name="NOM" placeholder="Nom" id="NOM"><br>
                        </div>
                        <div>
                            <label>Email :</label>
                            <input type="email" name="EMAIL" id="EMAIL" placeholder="Email" required><br>
                        </div>
                        <div>
                            <label>Prénom :</label>
                            <input type="text" name="PRENOM" id="PRENOM" placeholder="Prénom"><br>
                        </div>
                        <div>
                            <label>Ville :</label>
                            <input type="text" name="VILLE" id="VILLE" placeholder="Ville"><br>
                        </div>
                        <div>
                            <label>Web mobile :</label>
                            <input type="text" name="WEB_MOBILE" id="WEB_MOBILE" placeholder="Web Mobile"><br>
                        </div>
                        <div>
                            <label>Système exploitation :</label>
                            <input type="text" name="SYSTEME_EXPLOITATION" id="SYSTEME_EXPLOITATION" placeholder="Système Exploitation"><br>
                        </div>
                        <div>
                            <label>Adresse IP :</label>
                            <input type="text" name="ADRESSE_IP" id="ADRESSE_IP" placeholder="Adresse IP"><br>
                        </div>
                        <div>
                            <label>Maps :</label>
                            <input type="text" name="MAPS" id="MAPS" placeholder="Maps"><br>
                        </div>
                        <div>
                            <label>Image :</label>
                            <input type="text" name="IMAGE_ENTREE" id="IMAGE_ENTREE" placeholder="Image d'entrée"><br>
                        </div>
                        <div>
                            <label>Téléphone :</label>
                            <input type="number" name="numero_telephone" id="numero_telephone" placeholder="Numéro Téléphone" required><br>
                        </div>
                        <div>
                            <label>Navigateur :</label>
                            <input type="text" name="Navigateur" id="Navigateur" placeholder="Navigateur"><br>
                        </div>
                        <div>
                            <label>Date rendu :</label>
                            <input type="date" name="Date_prospect" id="Date_prospect" required><br>
                        </div>
                    </div>
                    <br />
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Ajouter le prospect</button>
                    </div>
                    <a class="btn btn-outline-info mb-5 mt-5" href="prospect.php">Revenir a la liste</a>

                </form>
            </div>
        </div>
    </div>
</body>

</html>