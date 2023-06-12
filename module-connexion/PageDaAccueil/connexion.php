<?php
$bdd = mysqli_connect("localhost", "root", "", "moduleconnexion"); // Connexion database...

if (isset($_POST["submit"])) //If we press the submit button
{
    if (!empty($_POST["login"]) and !empty($_POST["prenom"]) and !empty($_POST["nom"]) and !empty($_POST["password"]) and !empty($_POST["password2"]))  //If every value are not empty
    {

        $login = htmlspecialchars($_POST["login"]);  //Users variable information
        $prenom = htmlspecialchars($_POST["prenom"]);
        $nom = htmlspecialchars($_POST["nom"]);
        $password = ($_POST["password"]);
        $password2 = ($_POST["password2"]);

        $loginlenght = strlen($login); //Variable for the login lenght

        if ($loginlenght <= 255) {
            if ($password == $password2) {

                $password3 = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

                $sql = " INSERT INTO utilisateurs (login, prenom, nom, password) VALUES ('" . $login . "', '" . $prenom . "', '" . $nom . "', '" . $password3 . "');";

                if (!mysqli_query($bdd, $sql)) {
                    die('impossible d’ajouter cet enregistrement : ' .  mysqli_error($bdd));
                } else {
                    header('Location:connexion.php');
                }
            } else {
                $erreur = "Les mots de passe ne sont pas identique !";
            }
        } else {
            $erreur = "Votre pseudo ne doit pas depasser 255 caracteres !";
        }
    } else {
        $erreur = "Tous les champs ne sont pas remplis !";
    }
}
mysqli_close($bdd);

?>


<!-- Debut page display -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/inscription.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <header>
        <nav>
            <a href='../index.php'>Accueil</a>
            <?php if (isset($_SESSION['id'])) { ?>
                <a href="profil.php?id=" <?php $_SESSION['id'] ?>>Profil</a>
            <?php
            } else { ?><a href='inscription.php'>Inscription</a><?php } ?>

            <?php if (isset($_SESSION['id'])) { ?>
                <a href="deconnexion.php">Deconnexion</a>
            <?php } else { ?>
                <a href="connexion.php">Connexion</a>
            <?php } ?>
        </nav>
    </header>

    <main>

        <section class="flex-container">
            <!--Debut form -->
            <form method="post" action="">
                <article class="story">
                    <h1>Inscrivez-vous !</h1>
                    <p>Decouvrez avec Totoro le studio GHIBLI ...</p>
                </article>
                <fieldset>
                    <div class="formflex">
                        <label for="login">LOGIN</label>
                        <input type="text" name="login" id="login" placeholder="Votre login">
                    </div>

                    <div class="formflex">
                        <label for="prenom">PRENOM</label>
                        <input type="text" name="prenom" id="prenom" placeholder="Votre prenom">
                    </div>

                    <div class="formflex">
                        <label for="nom">NOM</label>
                        <input type="text" name="nom" id="nom" placeholder="Votre nom">
                    </div>

                    <div class="formflex">
                        <label for="password">MOT DE PASSE</label>
                        <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                    </div>

                    <div class="formflex">
                        <label for="password2">CONFIRMATION DU MOT DE PASSE</label>
                        <input type="password" name="password2" id="password2" placeholder="Confirmation">
                    </div>

                    <div class="formflex">
                        <input type="submit" name="submit" value="JE M'INSCRIS">
                    </div>
                    <div class="php">
                        <p>
                            <?php
                            if (isset($erreur)) {
                                echo $erreur;
                            }
                            ?>
                        </p>
                    </div>
                </fieldset>
            </form>
            <!--End form -->

            <img src="https://media.giphy.com/media/BOPrq7m5jYS1W/giphy.gif" alt="totorro" class="totoro">

        </section>
    </main>

    <footer>
        <p></p>
    </footer>

</body>

</html>

<!--End page display -->
