<?php
require 'user.php';

if (isset($_POST['id'])) {
    updateUser($_POST['id'], [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email']
    ]);
    header("Location: dashboard.php");
}
?>

<!-- Formulaire HTML pour la mise à jour -->
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Mettre à jour</button>
</form>