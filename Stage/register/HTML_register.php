<?php  
session_start();  
// Génération d'un nouveau token CSRF si non existant 
if (!isset($_SESSION['csrf_users']) || empty($_SESSION['csrf_users'])){     
    $_SESSION['csrf_users'] = bin2hex(random_bytes(32)); 
}  
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Connexion</title>
</head>

<body>
    <section>
        <img class='img_co' src="../images/img_accueil.png">
        <form action="PHP_Login.php" method="POST">
            <img class="logo" src="../images/logo.png">
            <div class="textbox">
                <h1>Crée un compte</h1>
                <div class="textbox_item">
                    <input type="text" name="nom" id="nom" placeholder="nom" required>
                </div>
                <div class="textbox_item">
                    <input type="text" name="prénom" id="prénom" placeholder="prénom" required>
                </div>
                <div class="textbox_item">
                    <input type="text" name="poste" id="poste" placeholder="poste" required>
                </div>
                <div class="textbox_item">
                    <input type="date de naissance" name="date de naissance" id="date de naissance"
                        placeholder="date de naissance" required>
                </div>
                <div class="textbox_item">
                    <input type="text" name="niveau de jeu" id="niveau de jeu" placeholder="niveau de jeu" required>
                </div>
                <div class="textbox_item">
                    <input type="club actuel" name="club actuel" id="club actuel" placeholder="club actuel" required>
                </div>
                <div class="textbox_item">
                    <input type="password" name="email" id="email" placeholder="email" required>
                </div>
                <div class="textbox_item">
                    <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
                </div>
                <input type="checkbox" name="justificatif" id="justificatif">

                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['csrf_users']); ?>">
                <button type="submit" name="connexion">CONNEXION A LA PLATEFORME<i
                        class="fa-solid fa-arrow-right"></i></button>
            </div>
            <p>Besoin d'assistance ? Contactez votre administrateur</p>
        </form>

    </section>
</body>

</html>