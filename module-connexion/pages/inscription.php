<?php
// Afficher les erreurs PDO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root', 'root'); //Database connexion`


if(isset($_POST['submit'])){
    if(isset($_POST['login']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['password'])){
        $login = $_POST['login'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['password'];

        $sql = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUES (?, ?, ?, ?);";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$login, $prenom, $nom, $password]);
        header("Location: connexion.php");
        exit();

    } else {
        echo "Tous les champs ne sont pas remplis.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<video autoplay muted loop id="myVideo">
  <source src="../images/beeconexion.mp4" type="video/mp4">
</video>
    <title>Inscription</title>
    <img class=abeille-container src="../images/abeillechic.jpg" alt="image abeille"> 

</head>
<body>
<style>
        body {
            font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
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
        h2{
            color: #333;
        }
        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 3px;
           
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            
            text-align: -webkit-center;
            
        }
        
        form    {
                width: 70%;
                font-family: Helvetica Neue,Helvetica,Arial,sans-serif; 
                font-weight: bold;
                padding: 20px;
                display: block;
                margin-left: auto;
                margin-right: auto;
                background-color: white;
                -webkit-box-shadow: 0px 3px 12px 0px rgba(0,0,0,0.42);
                -moz-box-shadow: 0px 3px 12px 0px rgba(0,0,0,0.42);
                box-shadow: 0px 3px 12px 0px rgba(0,0,0,0.42);

            }
            .formflex
            {
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                text-align: center;
                padding: 10px;
                font-family: Helvetica Neue,Helvetica,Arial,sans-serif; 
                color: white;
                

            }
                    label, input {
            display: block;
            margin-bottom: 10px;
        }
        input
            {
                border: none;
                background: none;
                border-radius: 5px;
                border: 1px solid white;
                background-color: white;
                padding: 5px;
                font-family: Helvetica Neue,Helvetica,Arial,sans-serif; 
                text-align: center;
            }
            
        a{
            text-decoration: none;
        }
        a:hover
        {
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
        color: #ab911d;
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

<div class="content">
    <header>
        <h1>Inscription</h1>
    </header>
    <main>
        <h2>Remplissez le formulaire d'inscription :</h2>
        <form method="POST" action="inscription.php">

      <p>
      <label for="login">Login </label>
      <input type="text" name="login" id="login">
      </p>
      <p>
      <label for="prenom">Prenom </label>
      <input type="text" name="prenom" id="prenom">
      </p>
      <p>
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom">
      </p>
      <p>
      <label for="password">Password</label>
      <input type="text" name="password" id="password">
      </p>
      <p>
      <input type="submit" name="submit" id="submit" value="Submit">
      </p>
    </form>
    <img class=abeille-container src="../images/abeillechic.jpg" alt="image abeille"> 

    </main>
</body>
</html>