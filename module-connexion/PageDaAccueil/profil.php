<?php
session_start(); //Session connect
$bdd = mysqli_connect("localhost", "root", "", "moduleconnexion"); // Connexion database...

if (isset($_SESSION["id"])) {
    if (isset($_POST['newlogin']) and !empty($_POST['newlogin'])) {
        $newlogin = htmlspecialchars($_POST["newlogin"]);

        $sql = "UPDATE utilisateurs SET login = '$newlogin' WHERE id = '" . $_SESSION["id"] . "'"; //Update login from the database with the new login
        $result = mysqli_query($bdd, $sql) or die(mysqli_error($bdd));
        header('Location: deconnexion.php');
    }

    if (isset($_POST['newprenom']) and !empty($_POST['newprenom'])) {  //Update prenom from the database whith the new prenom
        $newprenom = htmlspecialchars($_POST["newprenom"]);

        $sql = "UPDATE utilisateurs SET prenom = '$newprenom' WHERE id = '" . $_SESSION["id"] . "'";
        $result = mysqli_query($bdd, $sql) or die(mysqli_error($bdd));
        header('Location:deconnexion.php');
    }

    if (isset($_POST['newnom']) and !empty($_POST['newnom'])) { //Update nom from the database whith the new nom
        $newnom = htmlspecialchars($_POST["newnom"]);

        $sql = "UPDATE utilisateurs SET nom = '$newnom' WHERE id = '" . $_SESSION["id"] . "'";
        $result = mysqli_query($bdd, $sql) or die(mysqli_error($bdd));
        header('Location:deconnexion.php');
    }
    if (isset($_POST['newpassword']) and !empty($_POST['newpassword'])) {  //Update password from the database whith the new password
        $newpassword = htmlspecialchars($_POST["newpassword"]);
        $newpassword2 = password_hash($newpassword, PASSWORD_BCRYPT, array('cost' => 10));

        $sql = "UPDATE utilisateurs SET password = '$newpassword2' WHERE id = '" . $_SESSION["id"] . "'";
        $result = mysqli_query($bdd, $sql) or die(mysqli_error($bdd));
        header('Location: deconnexion.php');
    }

    $sql = "SELECT * FROM utilisateurs WHERE id = '" . $_SESSION["id"] . "'";  // Recovery User session ...
    $result = mysqli_query($bdd, $sql) or die(mysqli_error($bdd));
    $userinfo = mysqli_fetch_array($result);

    mysqli_close($bdd);
}

?>

<!-- Debut page display -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/profil.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<body>
    <header>
        <nav>
            <?php if (isset($_SESSION['id'])) { ?>
                <a href="profil.php?id=" <?php $_SESSION['id'] ?>>Profil</a>
            <?php
            } else { ?><a href='inscription.php'>Inscription</a><?php } ?>

            <?php if (isset($_SESSION['id'])) { ?>
                <a href="deconnexion.php">Deconnexion</a>
            <?php } else { ?>
                <a href="connexion.php">Connexion</a>
            <?php } ?>
            <?php if ($userinfo["login"] == "admin") {
                echo "<a href='admin.php'>Admin</a>";
            }
                ?>

        </nav>
    </header>

    <main>
        <article>
            <h1> Bienvenue <span><?php echo $userinfo["login"] . ' ' . "!"; ?></span> </h1>
            <h2>Tu peux modifier ton profil ici avec les champs deja pré-remplie ...</h2>
            <section>
                <!--Debut form -->
                <form method="post" action="">
                    <fieldset>
                        <div class="formflex">
                            <div>
                                <label for="login">login</label>
                                <input type="text" name="newlogin" id="login" placeholder="votre login" value="<?php echo $userinfo["login"]; ?>">
                            </div>
                            <div>
                                <label for="prenom">Prenom</label>
                                <input type="text" name="newprenom" id="prenom" placeholder="Votre prenom" value="<?php echo $userinfo["prenom"]; ?>">
                            </div>
                            <div>
                                <label for="nom">Nom</label>
                                <input type="text" name="newnom" id="nom" placeholder="Votre nom" value="<?php echo $userinfo["nom"]; ?>">
                            </div>
                            <div>
                                <label for="password">Mot de passe</label>
                                <input type="password" name="newpassword" id="password" placeholder="Votre mot de passe">
                            </div>
                            <input type="submit" name="submit" value="Modifie ton profil et retourne vers l'accueil">
                        </div>
                    </fieldset>

                </form>
                <!--End form -->
            </section>
            <section class="ghiblistory">
                <h3>Le studio Ghibli aura son propre parc d’attractions dès 2022 !</h3>
                <h4>Un premier aperçu en a été dévoilé sous la forme d’illustrations inspirées.</h4>
                <p>Ceux qui ont toujours préféré l’univers poético-nippon du studio Ghibli aux romances de Disney verront
                    « bientôt » leur patience récompensée : le mythique studio d’animation japonais, parent de films tels
                    que Le voyage de Chihiro, Princesse Mononoké ou encore Le château ambulant, aura bel et bien son parc thématique,
                    , qui devrait ouvrir à l’horizon 2022 d’après la préfecture d’Aichi.
                    C’est sur le site de l’exposition internationale de 2005, à Nagakute, que se dressera la réserve d’esprits Ghibli,
                    qui n’aura manifestement rien à envier à son musée déjà existant à Tokyo, à en croire une série d’illustrations
                    divulguant les plans du parc.
                </p>
                <section class="monoke-container">
                    <img src="../images/ima1.jpeg" alt="monoke">
                    <img src="../images/ima2.jpeg" alt="monoke">
                    <img src="../images/ima3.jpeg" alt="monoke">
                </section>
            </section>
        </article>
    </main>
    <footer>
    </footer>

</body>

</html>

<!--End page display -->