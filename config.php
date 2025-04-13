<?php
// Configuration de la base de données
$host = 'localhost'; // L’hôte de la base de données
$db = 'foot'; // Le nom de la base de données
$user = 'root'; // L’utilisateur de la base de données
$pass = ''; // Le mot de passe

// Connexion PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>