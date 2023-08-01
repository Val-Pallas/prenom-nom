<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root'); //Database connexion`

echo "ma session" . $_SESSION["id"];
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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Vos balises <meta> et <title> ici -->
    <style>
        body {
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        header {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

            background: rgb(231 202 36 / 50%);
            color: #fff;
            padding: 20px;
            text-align: center;
            text-decoration: underline;

        }

        h1 {
            margin: 20px;
            margin-right: 15px;
        }

        h2 {
            color: #333;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

            text-align: -webkit-center;

        }

        form {
            width: 70%;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-weight: bold;
            padding: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            -webkit-box-shadow: 0px 3px 12px 0px rgba(0, 0, 0, 0.42);
            -moz-box-shadow: 0px 3px 12px 0px rgba(0, 0, 0, 0.42);
            box-shadow: 0px 3px 12px 0px rgba(0, 0, 0, 0.42);

        }

        .formflex {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            text-align: center;
            padding: 10px;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            color: white;


        }

        label,
        input {
            display: block;
            margin-bottom: 10px;
        }

        input {
            border: none;
            background: none;
            border-radius: 5px;
            border: 1px solid white;
            background-color: white;
            padding: 5px;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            text-align: center;
        }

        a {
            display: flex;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

            color: black;
            padding: 10px;
            text-align: center;
        }

        a:hover {
            background-color: #f1f1f1;
        }

        .error-message {
            color: red;
        }

        #myVideo {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
        }

        .content {
            position: fixed;
            top: 0;
            background: rgb(231 202 36 / 50%);
            color: black;
            width: 100%;
        }

        .abeille-container {
            max-width: 10%;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            padding: 30px;
            text-align: -webkit-center;
        }
    </style>
    <video autoplay muted loop id="myVideo">
        <source src="../images/pisanlier.mp4" type="video/mp4">
    </video>
</head>

<body>
    <section class="content">
        <?php if (isset($_SESSION['id'])) { ?>
            <h2>Bienvenue, <?php echo $login; ?> !</h2>
        <?php } ?>

        <div>
            <form class="formulaire" action="profil.php" method="post">
            <ul>
                <br />
                    <h1>Modifier votre profil</h1>
                <br />
                <li>
                    <label for="login">login</label>
                    <input type="text" id="login" name="login" value="<?php echo $login; ?>" required>
                </li>
                <br />
                <li>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
                </li>
                <br />
                   <input type="submit" name="valider" value="Valider &#10004;" />
                    <a href="deconnexion.php">Deconnexion</a>
                    <br>
                    <a href="livre-or.php">Livre d'or</a>
                    <br>
                    <a href="commentaires.php">Commentaire</a>
                    <br>
            </ul>

        </form>
        </div>
       
    </section>

</body>

</html>