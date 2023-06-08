<?php

$host = 'localhost';  // Adresse du serveur de base de données
$dbname = 'moduleconnexion';  // Nom de votre base de données
$username = 'root';  // Nom d'utilisateur de la base de données
$password = 'root';  // Mot de passe de la base de données


// Créer une instance PDO pour la connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher un message d'erreur
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
?>
