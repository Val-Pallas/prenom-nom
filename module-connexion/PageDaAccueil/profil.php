<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["utilisateur_id"])) {
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

// Récupérer les informations de l'utilisateur à partir de la base de données
$utilisateurId = $_SESSION["utilisateur_id"];
$requete = "SELECT * FROM utilisateurs WHERE id = $utilisateurId";
$resultat = mysqli_query($connexion, $requete);

if ($resultat && mysqli_num_rows($resultat) > 0) {
    $utilisateur = mysqli_fetch_assoc($resultat);
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les nouvelles données du formulaire
    $login = $_POST["login"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $motDePasse = $_POST["password"];

    // Mettre à jour les informations de l'utilisateur dans la base de données
    $requete = "UPDATE utilisateurs SET login = '$login', prenom = '$prenom', nom = '$nom', password = '$motDePasse' WHERE id = $utilisateurId";

    if (mysqli_query($connexion, $requete)) {
        echo "Les informations ont été mises à jour avec succès.";
        // Mettre à jour les variables de session si nécessaire
        $_SESSION["utilisateur_login"] = $login;
    } else {
        echo "Erreur lors de la mise à jour des informations : " . mysqli_error($connexion);
    }
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
    <h2>Profil</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" value="<?php echo $utilisateur["login"]; ?>" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $utilisateur["prenom"]; ?>" required><br><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $utilisateur["nom"]; ?>" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>

<label for="confirmation_mot_de_passe">Confirmer le mot de passe :</label>
<input type="password" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" required><br><br>

<input type="submit" value="Modifier">
</form>
</body>
</html>

