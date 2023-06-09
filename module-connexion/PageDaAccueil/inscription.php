<?php
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

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $login = $_POST["login"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $motDePasse = $_POST["password"];
    $confirmationMotDePasse = $_POST["confirmation_mot_de_passe"];

    // Vérifier si les mots de passe correspondent
    if ($motDePasse == $confirmationMotDePasse) {
        // Insérer les données dans la base de données
        $requete = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUES ('$login', '$prenom', '$nom', '$motDePasse')";

        if (mysqli_query($connexion, $requete)) {
            // Rediriger vers la page de connexion
            header("Location: connexion.php");
            exit();
        } else {
            echo "Erreur lors de l'insertion des données: " . mysqli_error($connexion);
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirmation_mot_de_passe">Confirmer le mot de passe :</label>
        <input type="password" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" required><br><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
