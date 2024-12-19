<!-- Page pas bonne -->
<?php
require "function.php"; 
session_start();
require_once "config.php";

$pdo = connect();
// Configuration
$to = "shainalamapro@gmail.com"; // Adresse e-mail de l'administrateur
$subject = "Liste des prospects à appeler aujourd'hui";
$date = date("d/m/Y"); // Date actuelle

try {
    // Requête pour récupérer les prospects à appeler
    $query = $pdo->query("SELECT p.NOM, p.PRENOM, p.numero_telephone, p.EMAIL AS email_prospect, 
                             pa.EMAIL AS email_appel
                      FROM prospect p
                      INNER JOIN prospect_appel pa ON p.EMAIL = pa.EMAIL
                      WHERE pa.ID_APPEL = 1");



    $prospects = $query->fetchAll(PDO::FETCH_ASSOC);

    if (!$prospects) {
        $message = "Bonjour,\n\nAucun prospect à appeler pour le $date.\n\nBonne journée !";
    } else {
        // Construction du message avec la liste des prospects
        $message = "Bonjour,\n\nVoici la liste des prospects à appeler pour le $date :\n\n";

        foreach ($prospects as $prospect) {
            $message .= "- {$prospect['NOM']} {$prospect['PRENOM']} - {$prospect['numero_telephone']} ({$prospect_appel['EMAIL']})\n";
        }

        $message .= "\nBonne journée !";
    }

    // En-têtes de l'e-mail
    $headers = "From: no-reply@example.com" . "\r\n" .
               "Reply-To: no-reply@example.com" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Envoi de l'e-mail
    if (mail($to, $subject, $message, $headers)) {
        echo "E-mail envoyé avec succès.";
    } else {
        echo "Échec de l'envoi de l'e-mail.";
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>