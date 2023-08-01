<?php

session_start(); //Session connexion
$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root'); //Database connexion
?>

<!--Debut Display-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre-or</title>
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
            text-decoration: none;
        }

        a:hover {
            background-color: black;
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
            color: #f1f1f1;
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
</head>
<body>
<header>
    <nav class="nav">
        <a href='livre-or.php'>Livre d'or</a>

        <?php if (isset($_SESSION['id'])) { ?>
            <a href="profil.php?id=" <?php $_SESSION['id'] ?>>Profil</a>
            <a href="commentaires.php?id=" <?php $_SESSION['id'] ?>>Commentaires</a>
            <?php
        } else { ?>
            <a href="../index.php">Accueil</a>
            <a href="inscription.php">Inscription</a>
        <?php } ?>

        <?php if (isset($_SESSION['id'])) { ?>
            <a href="deconnexion.php">Deconnexion</a>
        <?php } else { ?>
            <a href="connexion.php">Connexion</a>
        <?php } ?>

    </nav>
</header>
<main>
    <article>
        <?php //Request for the information from the two tables
        $req = $bdd->prepare("SELECT commentaires.commentaire, commentaires.date, utilisateurs.login FROM commentaires INNER JOIN utilisateurs WHERE commentaires.id_utilisateur = utilisateurs.id ORDER BY commentaires.id DESC");
        $req-> execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>
    </article>

    <article>
        <?php //Loop for display
        foreach  ($resultat as $row)
        {
            $date=date('d/m/Y', strtotime($row["date"]));
            echo '<div class="commentaire"><p class="date">Posté le :  '.$date.'</p>'.' <p>par : '.$row['login']  . '</p>'    . '<p class="com">'. $row['commentaire']  .'</p></div>';
        }
        ?>
    </article>

    <article class="a">
        <?php //Display for the button if someone is connected or not
        if (isset($_SESSION['id'])) {

            echo "<a href=commentaires.php><p> Vos resentir par rapport aux abeilles</p> </a>";
            echo "<a href=deconnexion.php><p> Deconnexion</p> </a>";
        } else {
            echo "<a href=connexion.php><p>Connection </p></a>";
        }
        ?>
    </article>

</main>
<footer></footer>
</body>
</html>