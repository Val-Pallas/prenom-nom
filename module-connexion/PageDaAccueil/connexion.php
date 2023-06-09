<?php
session_start();

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
    $motDePasse = $_POST["password"];

    // Vérifier les informations de connexion dans la base de données
    $requete = "SELECT * FROM utilisateurs WHERE login = '.$login.'";
    $resultat = mysqli_query($connexion, $requete);
    var_dump($resultat);
    if ($resultat && mysqli_num_rows($resultat) > 0) {
        $utilisateur = mysqli_fetch_assoc($resultat);
        if (password_verify($motDePasse, $utilisateur["password"])) {
            // Les informations de connexion sont correctes, créer les variables de session
            $_SESSION["utilisateur_id"] = $utilisateur["id"];
            $_SESSION["utilisateur_login"] = $utilisateur["login"];

            // Rediriger vers la page d'accueil ou toute autre page appropriée
            header("Location: index.php");
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
