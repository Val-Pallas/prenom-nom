● Une page contenant un formulaire d’inscription (inscription.php) :
Le formulaire doit contenir l’ensemble des champs présents dans la table
“utilisateurs” (sauf “id”) + une confirmation de mot de passe. Dès qu’un
utilisateur remplit ce formulaire, les données sont insérées dans la base de
données et l’utilisateur est redirigé vers la page de connexion.

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
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $password = $_POST["password"];
    $confirmationMotDePasse = $_POST["confirmation_mot_de_passe"];

    // Vérifier si les mots de passe correspondent
    if ($motDePasse == $confirmationMotDePasse) {
        // Hasher le mot de passe
        $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

        // Insérer les données dans la base de données
        $requete = "INSERT INTO utilisateurs (nom, prenom, password) VALUES ('$nom', '$prenom', '$motDePasseHash')";

        if (mysqli_query($connexion, $requete)) {
            // Message de bienvenue
            $message = "Bienvenue, " . $nom . "! Votre inscription a été réussie.";

            // Rediriger vers la page d'accueil avec le message de bienvenue
            header("Location: index.php?message=" . urlencode($message));
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
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="password" required><br><br>

        <label for="confirmation_mot_de_passe">Confirmer le mot de passe :</label>
        <input type="password" name="confirmation_mot_de_passe" required><br><br>
       
        <input type="submit" value="S'inscrire">  
    

    </form>
</body>
</html>
