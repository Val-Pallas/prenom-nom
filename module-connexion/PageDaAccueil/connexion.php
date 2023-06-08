<?php
// Inclure le fichier de configuration de la base de données
require_once 'config.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté, auquel cas le rediriger vers une autre page
if (isset($_SESSION['user_id'])) {
    header('Location: index.php'); // URL de la page de destination
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Effectuer la vérification des informations d'identification en base de données
    // Remplacez cette partie avec votre propre logique de vérification en base de données
    // Exemple de requête avec PDO :
    $query = "SELECT * FROM utilisateurs WHERE login = :login AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe en base de données
    if ($user) {
        // Créer les variables de session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_login'] = $user['login'];

        // Rediriger vers une page de succès ou le tableau de bord par exemple
        header('Location: index.php'); // URL de la page de destination
        exit;
    } else {
        // Afficher un message d'erreur si les informations d'identification sont incorrectes
        $error = "Identifiants invalides.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
</head>

<body>
    <h2>Connexion</h2>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br><br>
        
        <label for="prenom">Prenom:</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Se connecter">
    </form>
</body>

</html>
