<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root'); //Database connexion`

echo "ma session".$_SESSION["id"];
// Récupération des informations actuelles de l'utilisateur depuis la base de données
$userID =  $_SESSION['id']; // Remplacez cette valeur par l'ID de l'utilisateur connecté


$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$req->execute(array($userID));

if ($req->rowCount() > 0) {
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $nom = $row["nom"];
    $prenom = $row["prenom"];
    $login = $row["login"];
    $password = $row["password"];


    print_r($row); // Utilisation de print_r pour afficher les détails de l'utilisateur
} else {
    echo "Utilisateur non trouvé.";
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nouveauNom = $_POST["nom"];
    $nouveauPrenom = $_POST["prenom"];
    $nouveauElogin = $_POST["login"];

    // Mise à jour des informations dans la base de données
    $updateSql = "UPDATE utilisateurs SET nom = '$nouveauNom', prenom = '$nouveauPrenom', login = '$nouveauElogin' WHERE id = $userID";
    if ($bdd->query($updateSql) === TRUE) {
        echo "Profil mis à jour avec succès.";
        // Vous pouvez rediriger l'utilisateur vers une autre page après la mise à jour du profil si nécessaire
    } else {
        echo "Erreur lors de la mise à jour du profil: "; 
    }
}
?>
<!-- profil.php -->
<!DOCTYPE html>
<html>
<head>
    <!-- Vos balises <meta> et <title> ici -->
</head>
<body>
<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');

// Récupération des informations actuelles de l'utilisateur depuis la base de données
// (Votre code existant ici)

?>

<!-- Placez cette section de code à l'endroit où vous souhaitez afficher le message de bienvenue -->
<?php if (isset($_SESSION['id'])) { ?>
    <h2>Bienvenue, <?php echo $login; ?> !</h2>
<?php } ?>

<section class="content">
    <div>
        <!-- Votre formulaire de modification existant ici -->

        <!-- Formulaire pour le commentaire -->
        <form method="POST" action="enregistrer_commentaire.php">
            <textarea name="commentaire" placeholder="Votre commentaire ici"></textarea>
            <br>
            <input type="submit" name="submit" value="Envoyer">
        </form>

    </div>
</section>

</body>
</html>

<!DOCTYPE html>
<html>
<video autoplay muted loop id="myVideo">
  <source src="../images/pisanlier.mp4" type="video/mp4">
</video>
      <title>Document</title>
      <meta charset="utf-8">
   </head>
   <body>
    <!-- Placez cette section de code à l'endroit où vous souhaitez afficher le message de bienvenue -->
<?php if(isset($_SESSION['id'])) { ?>
    <h2>Bienvenue, <?php echo $login; ?> !</h2>
<?php } ?>

   <style>
    </style>

<body>
    <section class="content">
        <div >
            <form class="formulaire" action="profil.php" method="post">
            
                    <br />
                        <h1>Modifier votre profil</h1>
                    <br />
                        <label for="login">login</label>
                        <input type="text" id="login" name="login" value="<?php echo $login; ?>" required>
                    
                        <label for="prenom">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" required>
                    <br>
                
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" required>
                
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
                
                    <br />
                        <input type="submit" name="valider" value="Valider &#10004;" />
                        <a href="deconnexion.php">Deconnexion</a>
                        <br />
            
                <form method="POST" action="enregistrer_commentaire.php">
                    <textarea name="commentaire" placeholder="Votre commentaire ici"></textarea>
                    <br>
                    <input type="submit" name="submit" value="Envoyer">
               
            </form>
            
        </div>

      
</section>
</body>

</html>