<?php
session_start();
// Vérifier si l'utilisateur est connecté et s'il est l'admin
if (!isset($_SESSION["utilisateur_id"]) || $_SESSION["utilisateur_login"] !== "admin") {
    // Rediriger vers la page de connexion ou toute autre page appropriée
    header("Location: connexion.php");
    exit();
}

// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "root";
$baseDeDonnees = "moduleconnexion";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion à la base de données
if (!$connexion) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}

// Récupérer toutes les informations des utilisateurs dans la base de données
$requete = "SELECT * FROM utilisateurs WHERE id = '" . $_SESSION["id"] . "'";
$resultat = mysqli_query($connexion, $requete);

if ($resultat && mysqli_num_rows($resultat) > 0) {
    // Afficher les informations des utilisateurs
    echo "<h2>Liste des utilisateurs :</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Login</th><th>Prénom</th><th>Nom</th></tr>";
    while ($utilisateur = mysqli_fetch_assoc($resultat)) {
        echo "<tr>";
        echo "<td>".$utilisateur["id"]."</td>";
        echo "<td>".$utilisateur["login"]."</td>";
        echo "<td>".$utilisateur["prenom"]."</td>";
        echo "<td>".$utilisateur["nom"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun utilisateur trouvé.";
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>
