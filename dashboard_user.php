<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: connection.php"); // Rediriger si non connecté
    exit();
}

echo "Bienvenue, " . $_SESSION['email'] . "! Vous êtes connecté en tant qu'utilisateur normal.";

// D'autres fonctionnalités pour les utilisateurs normaux...
?>