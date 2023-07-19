<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<video autoplay muted loop id="myVideo">
  <source src="../images/bee.mp4" type="video/mp4">
</video>
    <title>Page d'administration</title>
    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
        color: black;
        width: 100%;
        }
        a{
            text-decoration: none;
            color: violet;
        }

    </style>
<body>
    <div class="content">
        <a href="deconnexion.php">Deconnexion</a>
    <?php

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "moduleconnexion";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }


        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin') {
            $sql = "SELECT * FROM utilisateurs";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr>login";
            echo "<th></th>";
            echo "<th>Password</th>";
            echo "<th>Prenom</th>";
            echo "<th>Nom</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach ($utilisateurs as $key =>$user){
                echo '<tr>';
                echo '<td>' . $user['login'] . '</td>';
                echo '<td>' . $user['password'] . '</td>';
                echo '<td>' . $user['prenom'] . '</td>';
                echo '<td>' . $user['nom'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
        else{
            header("Location: index.php");
        }
        ?>
    </div>
</body>
</html>