<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="/media/examples/link-element-example.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/test.css">
</head>

<body>
    <nav>

        <a href='index.php'>Accueil</a>
        <?php if (isset($_SESSION['id'])) { ?>
            <a href="pages/profil.php?id=<?php echo $_SESSION['id'] ?>">Profil</a>
        <?php
        } else { ?><a href="../pages/inscription.php">Inscription</a><?php } ?>

        <?php if (isset($_SESSION['id'])) { ?>
            <a href="../pages/deconnexion.php">Deconnexion</a>
        <?php } else { ?>
            <a href="../pages/connexion.php">Connexion</a>
        <?php } ?>
    </nav>



    <main>
        <!-- Main content -->
        <div class="owl-carousel">
            <div class="item"><img src="images/panal.jpg" alt="panal"></div>
            <div class="item"><img src="images/abeillefleur.jpg" alt="abeille et fleur"></div>
            <div class="item"><img src="images/abeillesnice.jpg" alt="abeille de nice"></div>
            <div class="item"><img src="images/cera.jpg" alt="cera"></div>
        </div>
        
        <h3 class="card__title">Apis mellifera Côte d'Azur</h3>
        <div class="item"><img src="images/cerablanca.jpg" alt="cera"></div>
        <p> Les abeilles de la région peuvent être adaptées à des plantes spécifiques qui sont abondantes dans la région méditerranéenne. Il est important de noter que la santé et la survie des abeilles sont des préoccupations importantes, et des mesures sont prises pour les protéger et préserver leur habitat.</p>
        <h5>Groupies</h5>
        <p>Lorsqu'un essaim se forme, il peut prendre la forme d'une grappe d'abeilles qui se regroupent généralement sur une branche d'arbre, un poteau, ou tout autre support disponible. L'essaim en grappe est souvent composé de milliers d'abeilles et est dirigé par une reine.</p>
        <h5>Alvéoles</h5>
        <p>Pour fabriquer les alvéoles de cire, les abeilles ouvrières mâchent la cire et la modelent avec leurs mandib


        <p> Les abeilles de la région peuvent être adaptées à des plantes spécifiques qui sont abondantes dans la région méditerranéenne. Il est important de noter que la santé et la survie des abeilles sont des préoccupations importantes, et des mesures sont prises pour les protéger et préserver leur habitat.</p>
        <h5>Groupies</h5>
        <p>Lorsqu'un essaim se forme, il peut prendre la forme d'une grappe d'abeilles qui se regroupent généralement sur une branche d'arbre, un poteau, ou tout autre support disponible. L'essaim en grappe est souvent composé de milliers d'abeilles et est dirigé par une reine.</p>
        <h5>Alvéoles</h5>
        <p>Pour fabriquer les alvéoles de cire, les abeilles ouvrières mâchent la cire et la modelent avec leurs mandibules pour former des structures hexagonales régulières. Ces alvéoles sont utilisées comme cellules de stockage pour le miel, le pollen et les larves. Les alvéoles sont disposées côte à côte dans des cadres de rayons à l'intérieur de la ruche.</p>
    </main>
    <footer></footer>


</body>

</html>

<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel();
    });

    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    });
</script>