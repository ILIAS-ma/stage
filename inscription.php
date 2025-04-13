<?php
require 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $poste = $_POST['poste'];
    $niveau_jeu = $_POST['niveau_jeu'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $justificatif = $_FILES['justificatif'];
    $motDePasse = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);

    // Vérification si l'email existe déjà
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $message = "L'email est déjà utilisé.";
    } else {
        // Vérifier si le fichier a été téléchargé sans erreur
        if ($justificatif['error'] === UPLOAD_ERR_OK) {
            // Créer le répertoire si nécessaire
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            // Gérer le fichier upload
            $destination = 'uploads/' . basename($justificatif['name']);
            if (move_uploaded_file($justificatif['tmp_name'], $destination)) {
                // Insérer dans la base de données
                $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, date_naissance, poste, niveau_jeu, telephone, email, justificatif, mot_de_passe)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$nom, $prenom, $date_naissance, $poste, $niveau_jeu, $telephone, $email, basename($justificatif['name']), $motDePasse])) {
                    $message = "Inscription réussie !";
                } else {
                    $message = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            } else {
                $message = "Erreur lors de l'upload du fichier.";
            }
        } else {
            $message = "Le fichier n'a pas été téléchargé avec succès.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>

<body>
    <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
    <form method="post" enctype="multipart/form-data">
        Nom: <input type="text" name="nom" required><br>
        Prénom: <input type="text" name="prenom" required><br>
        Date de naissance: <input type="date" name="date_naissance" required><br>
        Poste: <input type="text" name="poste" required><br>
        Niveau de jeu: <input type="text" name="niveau_jeu" required><br>
        Téléphone: <input type="text" name="telephone" required><br>
        Email: <input type="email" name="email" required><br>
        Justificatif: <input type="file" name="justificatif" required><br>
        Mot de passe: <input type="password" name="mot_de_passe" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>

</html>