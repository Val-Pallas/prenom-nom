<?php
session_start(); // Session connexion ...
$bdd = mysqli_connect("localhost", "root", "", "moduleconnexion"); // Connexion database...
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <header>
        <nav>
            <a href='../index.php'>Accueil</a>
            <?php if (isset($_SESSION['id'])) { ?>
                <a href="profil.php?id=" <?php $_SESSION['id'] ?>>Profil</a>
            <?php
            } else { ?><a href="inscription.php">Inscription</a><?php } ?>

            <?php if (isset($_SESSION['id'])) { ?>
                <a href="deconnexion.php">Deconnexion</a>
            <?php } else { ?>
                <a href="connexion.php">Connexion</a>
            <?php } ?>
        </nav>

        <?php
        $sql = "SELECT * FROM utilisateurs WHERE id = '" . $_SESSION["id"] . "'";  // Recovery User session ...
        $result = mysqli_query($bdd, $sql) or die(mysqli_error($bdd));
        $userinfo = mysqli_fetch_array($result);
        ?>
    </header>
    <main>
        <section>
            <h1> Bienvenue <?php echo $_SESSION["login"]; ?> ! </h1>
            <h2>Ci-dessous la liste de vos utilisateurs et leur données ...</h2>
            <p>*Strictement confidentiel.</p>
        </section>
    </main>

    <?php
    if (isset($_SESSION["id"]) == "admin") {
        $request = "SELECT * FROM utilisateurs;";
        $query = mysqli_query($bdd, $request);

        $i = 0;

        echo "<table>";

        while ($result = mysqli_fetch_assoc($query)) {  //Loop for the field of the table from database
            if ($i == 0) {
                echo "<tr>";
                foreach ($result as $key => $value) {
                    echo "<th>$key</th>";
                }
                echo "</tr>";

                $i++;
            }

            echo "<tr>";
            foreach ($result as $key => $value) { //Loop for the value of the table from database
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
        mysqli_close($bdd);
    } else {
        echo "vous n'êtes pas administrateur!";
    }

    ?>

    <footer>
        <a href="../index.php">Retour à l'accueil</a>
    </footer>

</body>

</html>