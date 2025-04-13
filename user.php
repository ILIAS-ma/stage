<?php
require_once 'config.php'; // Inclure la connexion PDO

// Récupérer tous les utilisateurs
function readUsers() {
    global $pdo;

    $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM utilisateurs");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Mettre à jour un utilisateur
function updateUser($id, $data) {
    global $pdo;

    $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ? WHERE id = ?");
    $stmt->execute([$data['nom'], $data['prenom'], $data['email'], $id]);
}

// Supprimer un utilisateur et ses connexions associées
function deleteUser($id) {
    global $pdo;

    // Supprimer les connexions associées
    $stmt = $pdo->prepare("DELETE FROM connexions WHERE utilisateur_id = ?");
    $stmt->execute([$id]);

    // Maintenant, supprimer l'utilisateur
    $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);
}
?>