<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($motDePasse, $user['mot_de_passe'])) {
        // Enregistrer l'ID et l'email de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Gérer la connexion pour tous les utilisateurs
        $stmt = $pdo->prepare("INSERT INTO connexions (utilisateur_id, date_connexion) VALUES (?, NOW())");
        $stmt->execute([$user['id']]);
 
        // Maintenant, redirige l'utilisateur vers une page selon son statut
        if ($user['is_admin'] == 1) {
            header("Location: dashboard.php"); // page pour les admins
        } else {
            header("Location: dashboard_user.php"); // page pour les utilisateurs normaux
        }
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>
    <form method="post">
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="mot_de_passe" required><br>
        <input type="submit" value="Se connecter">
    </form>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>

</html>