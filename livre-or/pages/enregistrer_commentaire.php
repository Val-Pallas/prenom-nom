// enregistrer_commentaire.php
<?php
session_start();

if (isset($_SESSION['id']) && isset($_POST['commentaire'])) {
    $id_utilisateur = $_SESSION['id'];
    $commentaire = $_POST['commentaire'];
    
    $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root'); //Database connexion`
    // Vous pouvez ajouter des validations supplémentaires si nécessaire

    // Connexion à la base de données (placez ici le code de connexion à la base de données)

    $sql = "INSERT INTO commentaires (id_utilisateur, commentaire) VALUES (?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_utilisateur, $commentaire]);

    header("Location: profil.php");
    exit();
} else {
    header("Location: connexion.php");
    exit();
}
?>
