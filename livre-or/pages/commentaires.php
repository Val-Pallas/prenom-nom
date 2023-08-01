<?php
session_start();
//Session connexion
$bdd = new PDO( 'mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root' );
//Database connexion

if ( isset( $_SESSION[ 'id' ] ) ) {
    $req = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE id = ? ' );
    $req->execute( array( $_SESSION[ 'id' ] ) );
    $userinfo = $req->fetch();

    if ( isset( $_POST[ 'submit' ] ) ) {
        if ( !empty( $_POST[ 'description' ] ) and isset( $_POST[ 'description' ] ) ) {
            $id_utilisateur = $userinfo[ 'id' ];
            $description = htmlspecialchars( $_POST[ 'description' ] );
            $date = date( 'Y-m-d h:i:s' );

            $req = $bdd->prepare( 'INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?,?,?)' );
            $req->execute( array( $description, $id_utilisateur, $date ) );
            $error = 'Vous avez bien commenté';
        } else {
            $error = "Vous n'avez pas laissez de commentaires";
        }
    }
}

?>

<!--Debut Display-->

<!DOCTYPE html>
<html lang = 'fr'>

<head>
<meta charset = 'UTF-8'>
<title>Commentaires</title>
<style>
body {
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f1f1f1;
}

header {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

    background: rgb( 231 202 36 / 50% );
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
    box-shadow: 0 2px 5px rgba( 0, 0, 0, 0.3 );

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
    -webkit-box-shadow: 0px 3px 12px 0px rgba( 0, 0, 0, 0.42 );
    -moz-box-shadow: 0px 3px 12px 0px rgba( 0, 0, 0, 0.42 );
    box-shadow: 0px 3px 12px 0px rgba( 0, 0, 0, 0.42 );

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
    background: rgb( 231 202 36 / 50% );
    color: black;
    width: 100%;
}

.abeille-container {
    max-width: 10%;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    padding: 30px;

}
.cuadro {
 display: inline-flex;
}
.items {
    display:table-row-group;
}
</style>
</head>

<body>
<main>
<article>
<!--Debut form -->
<form method = 'post' action = ''>
<h1>Laissez-nous votre Commentaire!</h1>
<div class = 'formflex'>
<div>
<!--<label for = 'description'>Commentaires</label>-->
<textarea id = 'description' name = 'description' rows = '8' cols = '60' placeholder = 'Ecris !' minlength = '3' maxlength = '255'></textarea>
</div>
<br>
</div>
<div class = 'd-grid gap-2'>
<button><input class = 'btn btn-primary' type = 'submit' name = 'submit' value = 'Commentes !'></button>

</div>
<?php
if ( isset( $error ) ) {
    echo $error;
}
?>
</form>
<!--End form -->
</article>
<br>
<footer>

<nav class = 'nav'>
    <div class= 'cuadro'>
        <div class= 'items'>
            <br>
            <a href = 'livre-or.php'>Livre d'or</a>
            <br>
            <?php if (isset($_SESSION['id'])) { ?>
                <a href="profil.php?id=" <?php $_SESSION['id'] ?>>Profil</a>
                <br>
                <a href="commentaire.php?id=" <?php $_SESSION['id'] ?>>Commentaires</a>
                <br>
                <?php
                } else { ?><a href="inscription.php">Inscription</a><?php } ?>
                <br>
            <?php if (isset($_SESSION['id' ] ) ) {
                ?>
                <a href = 'deconnexion.php'>Deconnexion</a>
                <br>
                <?php } else {
                    ?>
                    <br>
                    <a href = 'connexion.php'>Connexion</a>
                    <?php }
                    ?>
                </div>
            <div class="item">
                <img src="https://media2.giphy.com/media/02zR80wC1JkfG4wYyi/giphy.gif?cid=ecf05e47o65y6rgbgvyibe6x47nmuy2ijcc6mtirab793q7p&ep=v1_gifs_search&rid=giphy.gif&ct=g" alt="gif abeille">
            </div>
        </div>
    </nav>
</footer>
</main>
</body>

</html>