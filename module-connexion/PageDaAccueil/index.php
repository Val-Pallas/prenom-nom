<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Connexionw</title>
    <link href="/media/examples/link-element-example.css" rel="stylesheet">
    <button id="drawButton">Draw</button>
    <div id="drawResult"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<?php
// Vérifier si un message a été passé en paramètre d'URL
if (isset($_GET["message"])) {
    $message = $_GET["message"];
    // Afficher le message de bienvenue
    echo "<p>" . htmlspecialchars($message) . "</p>";
}
?>
<!-- Reste de votre code HTML pour la page d'accueil -->

<body>
    <nav>
        <div id="center_button"><button onclick="location.href='connexion.php'">Log in</button></div>
        <div id="center_button"><button onclick="location.href='inscription.php'">Inscription</button></div>
        <div id="center_button"><button onclick="location.href='profil.php'">Profil</button></div>

    </nav>
    <h2>Abeilles</h2>
    <p>
        Une abeille est un insecte de l'ordre des hyménoptères, appartenant à la famille des Apidae. Les abeilles sont connues pour leur rôle essentiel dans la pollinisation des plantes. Elles sont généralement de petite taille, avec un corps divisé en trois parties distinctes : la tête, le thorax et l'abdomen. Elles ont six pattes, deux paires d'ailes membraneuses et une paire d'antennes.

        Les abeilles sont socialement organisées en colonies, avec une division des tâches bien définie. Chaque colonie est dirigée par une reine, qui est la seule femelle fertile et responsable de la ponte des œufs. Les mâles, appelés faux-bourdons, ont pour rôle de féconder la reine. Les ouvrières, qui sont des femelles stériles, s'occupent de la collecte de nectar et de pollen, de la construction des rayons de cire, de l'entretien de la ruche et de la protection de la colonie.

        Les abeilles sont également connues pour produire du miel, une substance sucrée et visqueuse qu'elles fabriquent à partir du nectar des fleurs. Le miel est utilisé comme source de nourriture par les abeilles, mais il est également récolté par les apiculteurs pour sa valeur nutritionnelle et sa saveur sucrée.

        Les abeilles jouent un rôle crucial dans la pollinisation des plantes, ce qui contribue à la reproduction des fleurs et à la production de fruits et de graines. Leur activité pollinisatrice est vitale pour maintenir l'équilibre de nombreux écosystèmes et soutenir la biodiversité.
    </p>
    <button id="drawButton">Draw</button>
    <div id="drawResult"></div>

    <script>
        $(document).ready(function() {
            $('#drawButton').click(function() {
                $.ajax({
                    url: '/draw',
                    type: 'GET',
                    success: function(response) {
                        $('#drawResult').text(response.result);
                    }
                });
            });
        });
    </script>
</body>

</html>