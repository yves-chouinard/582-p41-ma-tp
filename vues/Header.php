<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Source+Sans+Pro" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <div class="titre-site">Le Forum de Montréal</div>
            
            <?php
                if (isset($_SESSION['usager'])) {
                    afficheBarreNav();
                }
            ?>
        </header>
        
        <main>
            
<?php
    
function afficheBarreNav() {
    $nomUsager = htmlspecialchars($_SESSION['usager']->nom_usager);
    $nomUsager .= $_SESSION['usager']->est_admin ? " (admin)" : "";
?>
    <nav>
        <a href="index.php?sujets">Liste des sujets</a>

        <?php if ($_SESSION['usager']->est_admin) { ?>
            <a href="index.php?usagers&action=admin">Administration</a>
        <?php } ?>
        
        <div class="session">
            <span><?= $nomUsager ?> - </span>
            <a href="index.php?usagers&action=fermeSession">Fermer la session</a>
        </div>
    </nav>
<?php           
}
